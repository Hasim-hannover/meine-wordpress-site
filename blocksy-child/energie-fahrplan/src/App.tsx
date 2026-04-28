import React, { useState, useMemo, useEffect } from "react";
import { 
  Sun, 
  Battery, 
  Euro, 
  ChevronRight, 
  ChevronLeft, 
  Download, 
  Zap, 
  BarChart3, 
  Info,
  HelpCircle,
  TrendingUp,
  LayoutDashboard,
  CheckCircle2,
  FileText
} from "lucide-react";
import { motion, AnimatePresence } from "motion/react";
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  BarElement,
  Title,
  Tooltip,
  Legend,
  Filler,
  ArcElement
} from "chart.js";
import { Bar, Doughnut, Line, Chart } from "react-chartjs-2";
import jsPDF from "jspdf";
import html2canvas from "html2canvas";

// Register ChartJS
ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  BarElement,
  Title,
  Tooltip,
  Legend,
  Filler,
  ArcElement
);

// --- CONFIGURATION ---
const CONFIG = {
  aiEndpoint: null,
  trackingEndpoint: null,
  metaPixelId: null,
  isDemo: true, // Default to demo mode
};

// --- TYPES ---
interface UserData {
  annualConsumption: number;
  roofArea: number;
  orientation: "S" | "SW/SE" | "W/E" | "N";
  inclination: number;
  pvSize: number; // in kWp
  storageSize: number; // in kWh
  hasWallbox: boolean;
}

interface CalculationResult {
  annualYield: number; // kWh
  autarchyRate: number; // %
  selfConsumptionRate: number; // %
  annualSavings: number; // €
  investmentCost: number; // €
  fundingAmount: number; // €
  amortizationYears: number; // Years
}

// --- UTILS ---
const trackEvent = (name: string, data: any) => {
  if (CONFIG.isDemo) {
    console.log(`[Demo Track] ${name}`, data);
    return;
  }
  if (CONFIG.trackingEndpoint) {
    fetch(CONFIG.trackingEndpoint, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ event: name, data, timestamp: new Date().toISOString() }),
    }).catch(console.error);
  }
};

const getAIAdvice = async (userData: UserData): Promise<string> => {
  if (CONFIG.isDemo) {
    return `Basierend auf Ihrem Jahresverbrauch von ${userData.annualConsumption} kWh und Ihrer Dachausrichtung (${userData.orientation}), empfehle ich eine PV-Anlage mit mindestens ${userData.pvSize.toFixed(1)} kWp. 
    
Ihr gewählter Speicher von ${userData.storageSize} kWh ist optimal dimensioniert, um Ihren Autarkiegrad deutlich über 70% zu heben. 
    
Besonders attraktiv ist die Kombination mit einer Wallbox, da Sie so Ihren Eigenverbrauch weiter maximieren können. Die prognostizierte Amortisationszeit von ca. 10-12 Jahren macht dieses Projekt zu einer exzellenten finanziellen Entscheidung.`;
  }

  try {
    const response = await fetch(CONFIG.aiEndpoint || "", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(userData),
    });
    const data = await response.json();
    return data.advice;
  } catch (error) {
    return "Die KI-Beratung ist momentan nicht verfügbar. Bitte versuchen Sie es später erneut.";
  }
};

// --- CALCULATION ENGINE ---
const calculateSolarSystem = (data: UserData): CalculationResult => {
  const { annualConsumption, pvSize, storageSize, orientation, inclination } = data;

  // 1. Annual Yield Calculation (Approximate factors for Germany)
  let orientationFactor = 1.0;
  if (orientation === "SW/SE") orientationFactor = 0.95;
  if (orientation === "W/E") orientationFactor = 0.85;
  if (orientation === "N") orientationFactor = 0.55;

  // Basic yield: 1000 kWh per 1 kWp under ideal conditions
  const baseYield = 1000; 
  const annualYield = pvSize * baseYield * orientationFactor;

  // 2. Autarchy and Self-Consumption (simplified model)
  // Without storage: roughly 30% autarchy
  // With storage: goes up to ~80% degressively
  const maxAutarchyWithYield = Math.min(100, (annualYield / annualConsumption) * 100);
  
  // Base autarchy without storage
  let baseAutarchy = Math.min(30, maxAutarchyWithYield * 0.4);
  
  // Add storage boost (sqrt for degressive effect)
  const storageBoost = storageSize > 0 ? Math.min(50, Math.sqrt(storageSize) * 15) : 0;
  const autarchyRate = Math.min(90, baseAutarchy + storageBoost);
  
  const annualSelfConsumedKwh = (annualConsumption * autarchyRate) / 100;
  const selfConsumptionRate = (annualSelfConsumedKwh / annualYield) * 100;

  // 3. Financials
  const electricityPrice = 0.35; // €/kWh
  const feedInTariff = 0.082; // €/kWh (EEG 2024 approx)
  
  const savingsFromSelfConsumption = annualSelfConsumedKwh * electricityPrice;
  const earningsFromFeedIn = Math.max(0, annualYield - annualSelfConsumedKwh) * feedInTariff;
  const annualSavings = savingsFromSelfConsumption + earningsFromFeedIn;

  // Investment Costs (Estimates)
  const costPerKwp = 1400; // €/kWp
  const costPerKwhStorage = 800; // €/kWh
  const wallboxCost = data.hasWallbox ? 1200 : 0;
  
  const investmentCost = (pvSize * costPerKwp) + (storageSize * costPerKwhStorage) + wallboxCost;

  // KfW 442 logic (if eligible - simplified)
  let fundingAmount = 0;
  if (data.hasWallbox && pvSize >= 5 && storageSize >= 5) {
    fundingAmount = (pvSize * 600) + (storageSize * 250) + 600; // fixed amounts example
    fundingAmount = Math.min(investmentCost * 0.4, 10200); // capped
  }

  const netInvestment = investmentCost - fundingAmount;
  const amortizationYears = annualSavings > 0 ? netInvestment / annualSavings : 99;

  return {
    annualYield,
    autarchyRate,
    selfConsumptionRate,
    annualSavings,
    investmentCost,
    fundingAmount,
    amortizationYears
  };
};

export default function App() {
  const [step, setStep] = useState(1);
  const [userData, setUserData] = useState<UserData>({
    annualConsumption: 4000,
    roofArea: 50,
    orientation: "S",
    inclination: 35,
    pvSize: 8,
    storageSize: 5,
    hasWallbox: true
  });
  const [aiAdvice, setAiAdvice] = useState<string>("");
  const [loadingAi, setLoadingAi] = useState(false);

  const results = useMemo(() => calculateSolarSystem(userData), [userData]);

  useEffect(() => {
    trackEvent("page_view", { step });
  }, [step]);

  const handleNext = () => {
    if (step === 2) {
      handleGetAdvice();
    }
    setStep(s => Math.min(s + 1, 4));
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };
  const handlePrev = () => setStep(s => Math.max(s - 1, 1));

  const handleGetAdvice = async () => {
    setLoadingAi(true);
    const advice = await getAIAdvice(userData);
    setAiAdvice(advice);
    setLoadingAi(false);
  };

  const exportPDF = async () => {
    const element = document.getElementById("report-area");
    if (!element) return;
    
    trackEvent("export_pdf", { data: userData });
    
    const canvas = await html2canvas(element, { scale: 2 });
    const imgData = canvas.toDataURL("image/png");
    const pdf = new jsPDF("p", "mm", "a4");
    const imgProps = pdf.getImageProperties(imgData);
    const pdfWidth = pdf.internal.pageSize.getWidth();
    const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
    
    pdf.addImage(imgData, "PNG", 0, 0, pdfWidth, pdfHeight);
    pdf.save("SolarExpert_Report.pdf");
  };

  const StepsIndicator = () => (
    <div className="sticky top-0 z-[60] bg-white/70 backdrop-blur-md border-b border-slate-200/50 -mx-4 sm:-mx-8 lg:-mx-12 mb-8 px-4 py-4">
      <div className="max-w-2xl mx-auto flex justify-between items-center relative">
        {[1, 2, 3, 4].map((num) => (
          <div key={num} className="flex flex-col items-center flex-1 relative group cursor-pointer" onClick={() => step > num && setStep(num)}>
            <div 
              className={`w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold z-10 transition-all duration-500 transform ${
                step >= num ? "bg-brand-primary text-white scale-110 shadow-lg shadow-brand-primary/20" : "bg-slate-100 text-slate-400"
              }`}
            >
              {step > num ? <CheckCircle2 className="w-6 h-6" /> : num}
            </div>
            <span className={`mt-2 text-[10px] uppercase tracking-wider font-bold transition-colors ${step >= num ? "text-brand-primary" : "text-slate-400"}`}>
              {num === 1 ? "Basis" : num === 2 ? "System" : num === 3 ? "Vorteile" : "Beratung"}
            </span>
            {num < 4 && (
              <div className={`absolute h-[2px] w-full top-5 left-1/2 -z-0 overflow-hidden`}>
                <div className={`h-full bg-slate-100 w-full absolute`} />
                <motion.div 
                  initial={false}
                  animate={{ width: step > num ? "100%" : "0%" }}
                  className="h-full bg-brand-primary absolute transition-all duration-700"
                />
              </div>
            )}
          </div>
        ))}
      </div>
    </div>
  );

  return (
    <div className="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
      <div className="max-w-5xl mx-auto">
        <header className="text-center mb-0 pb-12">
          <div className="flex justify-center gap-4 mb-8">
            <div className="flex items-center gap-2 px-3 py-1 bg-white border border-slate-200 rounded-full shadow-sm text-[10px] font-bold text-slate-500">
               <img src="https://upload.wikimedia.org/wikipedia/commons/d/d4/Fraunhofer-Gesellschaft_Logo.svg" alt="Fraunhofer" className="h-3 grayscale opacity-70" />
               Zertifizierte Daten
            </div>
            <div className="flex items-center gap-2 px-3 py-1 bg-white border border-slate-200 rounded-full shadow-sm text-[10px] font-bold text-slate-500">
               <CheckCircle2 className="w-3 h-3 text-brand-primary" />
               Regionale Anbieter
            </div>
          </div>
          
          <div className="inline-flex items-center gap-2 px-4 py-1.5 bg-brand-primary/10 text-brand-primary rounded-full text-xs font-extrabold mb-6 animate-pulse">
            <Zap className="w-3.5 h-3.5 fill-current" />
             <span>BEREITS 1.240 HAUSHALTE IN IHRER REGION OPTIMIERT</span>
          </div>
          
          <h1 className="text-5xl sm:text-6xl font-display font-black text-slate-900 mb-6 leading-[1.1]">
            SolarExpert <span className="text-brand-primary">AI</span>
          </h1>
          <p className="text-xl text-slate-500 max-w-xl mx-auto font-medium leading-relaxed">
            In 2 Minuten zur maximalen Autarkie. <br className="hidden sm:block" />
            Wissenschaftlich fundierte PV-Planung.
          </p>
        </header>

        <StepsIndicator />

        <div className="glass rounded-[2rem] p-6 sm:p-12 transition-all relative overflow-hidden group">
          <div className="absolute top-0 right-0 w-64 h-64 bg-brand-primary/5 rounded-full blur-3xl -mr-32 -mt-32" />
          <div className="absolute bottom-0 left-0 w-64 h-64 bg-brand-secondary/5 rounded-full blur-3xl -ml-32 -mb-32" />
          
          <AnimatePresence mode="wait">
            {step === 1 && (
              <motion.div 
                key="step1"
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                exit={{ opacity: 0, y: -20 }}
                className="grid grid-cols-1 md:grid-cols-2 gap-12 relative z-10"
              >
                <div className="space-y-10">
                  <div className="space-y-4">
                    <h2 className="text-3xl font-display font-extrabold flex items-center gap-3">
                      Starten wir mit der <span className="text-brand-primary">Basis</span>.
                    </h2>
                    <p className="text-slate-500 font-medium">Dies hilft der KI, Ihre individuellen Sparpotentiale präzise zu ermitteln.</p>
                  </div>
                  
                  <div className="space-y-8">
                    <div>
                      <div className="flex justify-between items-end mb-4">
                        <label className="block text-sm font-bold text-slate-800 uppercase tracking-wider">
                          Jahresverbrauch
                        </label>
                        <span className="text-3xl font-black text-brand-primary">{userData.annualConsumption.toLocaleString()} <span className="text-sm font-bold text-slate-400">kWh</span></span>
                      </div>
                      <input 
                        type="range" min="1000" max="15000" step="100"
                        value={userData.annualConsumption}
                        onChange={(e) => setUserData({...userData, annualConsumption: parseInt(e.target.value)})}
                        className="w-full h-3 bg-slate-100 rounded-full appearance-none cursor-pointer accent-brand-primary hover:accent-brand-primary/80 transition-all"
                      />
                    </div>

                    <div className="space-y-4">
                      <label className="block text-sm font-bold text-slate-800 uppercase tracking-wider mb-2">
                        Dachausrichtung
                      </label>
                      <div className="grid grid-cols-2 gap-4">
                        {(["S", "SW/SE", "W/E", "N"] as const).map((o) => (
                          <button
                            key={o}
                            onClick={() => {
                              setUserData({...userData, orientation: o});
                              setTimeout(handleNext, 400);
                            }}
                            className={`group relative overflow-hidden py-5 px-4 rounded-2xl border-2 transition-all duration-300 ${
                              userData.orientation === o 
                              ? "border-brand-primary bg-brand-primary/5 text-brand-primary ring-4 ring-brand-primary/10" 
                              : "border-slate-100 bg-slate-50/50 hover:border-slate-300 hover:bg-white"
                            }`}
                          >
                            <span className="relative z-10 text-sm font-extrabold">
                              {o === "S" ? "Direkt Süd" : o === "SW/SE" ? "Süd-West / Ost" : o === "W/E" ? "West / Ost" : "Norden"}
                            </span>
                            {userData.orientation === o && (
                              <motion.div layoutId="orient-bg" className="absolute inset-0 bg-brand-primary/10" />
                            )}
                          </button>
                        ))}
                      </div>
                    </div>
                  </div>
                </div>

                <div className="flex flex-col gap-6">
                  <div className="bg-slate-900 glass-dark rounded-3xl p-8 text-white relative overflow-hidden ring-1 ring-white/10">
                    <div className="relative z-10 space-y-6">
                      <div className="h-12 w-12 bg-brand-primary/20 rounded-xl flex items-center justify-center border border-brand-primary/30">
                        <TrendingUp className="w-6 h-6 text-brand-primary" />
                      </div>
                      <div className="space-y-2">
                        <h3 className="text-2xl font-black">Profitieren Sie vom Sonnen-Wachstum.</h3>
                        <p className="text-slate-400 font-medium text-sm leading-relaxed">
                          Mit der aktuellen Energiepreisentwicklung amortisiert sich Ihre Anlage im Schnitt <span className="text-white font-bold">15% schneller</span> als noch 2022.
                        </p>
                      </div>
                    </div>
                    <div className="absolute -right-8 -bottom-8 opacity-10">
                      <Sun className="w-48 h-48" />
                    </div>
                  </div>

                  <div className="bg-white border-2 border-dashed border-slate-200 rounded-3xl p-8 flex flex-col items-center text-center gap-4">
                    <div className="flex -space-x-3 mb-2">
                      {[1, 2, 3].map(i => (
                        <div key={i} className="w-10 h-10 rounded-full border-2 border-white bg-slate-200 overflow-hidden">
                          <img src={`https://i.pravatar.cc/100?u=${i}`} alt="User" />
                        </div>
                      ))}
                      <div className="w-10 h-10 rounded-full border-2 border-white bg-brand-primary text-white text-[10px] font-black flex items-center justify-center">
                        +1.2k
                      </div>
                    </div>
                    <p className="text-slate-500 font-bold text-sm">
                      „Hunderte Nutzer haben allein diesen Monat ihren Autarkiegrad verdoppelt.“
                    </p>
                  </div>
                </div>
              </motion.div>
            )}

            {step === 2 && (
              <motion.div 
                key="step2"
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                exit={{ opacity: 0, y: -20 }}
                className="grid grid-cols-1 md:grid-cols-2 gap-12 relative z-10"
              >
                <div className="space-y-10">
                  <div className="space-y-4">
                    <h2 className="text-3xl font-display font-extrabold flex items-center gap-3">
                      Ihr <span className="text-brand-primary">Power-Set</span>.
                    </h2>
                    <p className="text-slate-500 font-medium">Maximieren Sie Ihre Unabhängigkeit mit der richtigen Hardware.</p>
                  </div>

                  <div className="space-y-10">
                    <div>
                      <div className="flex justify-between items-end mb-4">
                        <label className="block text-sm font-bold text-slate-800 uppercase tracking-wider">
                          Anlagengröße
                        </label>
                        <span className="text-3xl font-black text-brand-primary">{userData.pvSize} <span className="text-sm font-bold text-slate-400">kWp</span></span>
                      </div>
                      <input 
                        type="range" min="3" max="30" step="0.5"
                        value={userData.pvSize}
                        onChange={(e) => setUserData({...userData, pvSize: parseFloat(e.target.value)})}
                        className="w-full h-3 bg-slate-100 rounded-full appearance-none cursor-pointer accent-brand-primary"
                      />
                    </div>

                    <div>
                      <div className="flex justify-between items-end mb-4">
                        <label className="block text-sm font-bold text-slate-800 uppercase tracking-wider">
                          Stromspeicher
                        </label>
                        <span className="text-3xl font-black text-brand-primary">
                          {userData.storageSize > 0 ? `${userData.storageSize} kWh` : "Ohne"}
                        </span>
                      </div>
                      <input 
                        type="range" min="0" max="25" step="1"
                        value={userData.storageSize}
                        onChange={(e) => setUserData({...userData, storageSize: parseInt(e.target.value)})}
                        className="w-full h-3 bg-slate-100 rounded-full appearance-none cursor-pointer accent-brand-primary"
                      />
                    </div>

                    <div className={`p-6 rounded-2xl border-2 transition-all cursor-pointer flex items-center justify-between ${userData.hasWallbox ? "border-brand-primary bg-brand-primary/5 ring-4 ring-brand-primary/5" : "border-slate-100 bg-slate-50/50 hover:border-slate-300"}`} onClick={() => setUserData({...userData, hasWallbox: !userData.hasWallbox})}>
                      <div className="flex items-center gap-4">
                        <div className={`w-12 h-12 rounded-xl flex items-center justify-center transition-colors ${userData.hasWallbox ? "bg-brand-primary text-white" : "bg-slate-200 text-slate-400"}`}>
                          <Zap className="w-6 h-6" />
                        </div>
                        <div>
                          <span className="block font-black text-slate-800">Wallbox (E-Auto)</span>
                          <span className="text-xs font-bold text-brand-primary">HÖCHSTE FÖRDERUNG</span>
                        </div>
                      </div>
                      <div className={`w-6 h-6 rounded-full border-2 flex items-center justify-center transition-all ${userData.hasWallbox ? "bg-brand-primary border-brand-primary" : "border-slate-300"}`}>
                        {userData.hasWallbox && <CheckCircle2 className="w-4 h-4 text-white" />}
                      </div>
                    </div>
                  </div>
                </div>

                <div className="space-y-6">
                  <div className="bg-slate-900 glass-dark rounded-3xl p-8 text-white relative overflow-hidden shadow-2xl">
                    <div className="relative z-10 space-y-8">
                      <div className="flex justify-between items-start">
                        <span className="px-3 py-1 bg-white/10 rounded-full text-[10px] font-black uppercase tracking-widest text-brand-primary">Echtzeit-Analyse</span>
                        <Sun className="w-8 h-8 text-yellow-400 animate-pulse" />
                      </div>
                      
                      <div className="space-y-1 mb-8">
                        <span className="text-slate-400 font-bold text-sm">PROGNOSTIZIERTE AUTARKIE</span>
                        <h3 className="text-6xl font-black text-brand-primary tracking-tighter">{results.autarchyRate.toFixed(0)}%</h3>
                      </div>
                      
                      <div className="grid grid-cols-2 gap-4">
                        <div className="bg-white/5 rounded-2xl p-4 border border-white/10">
                          <span className="block text-[10px] font-bold text-slate-400 mb-1 uppercase tracking-wider">Ertrag / Jahr</span>
                          <span className="text-xl font-black">{results.annualYield.toLocaleString()} kWh</span>
                        </div>
                        <div className="bg-white/5 rounded-2xl p-4 border border-white/10">
                          <span className="block text-[10px] font-bold text-slate-400 mb-1 uppercase tracking-wider">CO₂ Ersparnis</span>
                          <span className="text-xl font-black text-emerald-400">~{(results.annualYield * 0.47).toFixed(1)} t</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <AnimatePresence>
                  {userData.hasWallbox && userData.pvSize >= 5 && userData.storageSize >= 5 && (
                    <motion.div 
                      initial={{ opacity: 0, scale: 0.9 }}
                      animate={{ opacity: 1, scale: 1 }}
                      exit={{ opacity: 0, scale: 0.9 }}
                      className="bg-amber-50 border border-amber-200 p-6 rounded-2xl flex items-start gap-4 shadow-lg shadow-amber-500/10"
                    >
                      <div className="p-3 bg-amber-500 rounded-xl text-white shadow-lg shadow-amber-500/20">
                        <Euro className="w-5 h-5" />
                      </div>
                      <div>
                        <div className="flex items-center gap-2 mb-1">
                           <span className="block font-black text-amber-900 uppercase text-xs tracking-wider">Klimabonus Aktiv!</span>
                           <span className="px-2 py-0.5 bg-amber-500 text-white text-[9px] font-black rounded-full animate-bounce">FOMO</span>
                        </div>
                        <span className="text-sm font-medium text-amber-700 leading-relaxed">
                          Sie sichern sich ca. <span className="font-extrabold text-amber-900">{results.fundingAmount.toLocaleString()} €</span> Direktförderung (KfW 442). Nur solange Vorrat reicht!
                        </span>
                      </div>
                    </motion.div>
                  )}
                  </AnimatePresence>
                </div>
              </motion.div>
            )}

            {step === 3 && (
              <motion.div 
                key="step3"
                initial={{ opacity: 0, scale: 0.98 }}
                animate={{ opacity: 1, scale: 1 }}
                exit={{ opacity: 0, scale: 1.02 }}
                id="report-area"
                className="space-y-12 relative z-10"
              >
                <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                  <div>
                    <h2 className="text-4xl font-display font-black mb-2">Ihre <span className="text-brand-primary">Erfolgs-Analyse</span>.</h2>
                    <p className="text-slate-500 font-bold uppercase tracking-widest text-[10px]">Konfigurations-ID: {Math.random().toString(36).substr(2, 6).toUpperCase()}</p>
                  </div>
                  <button 
                    onClick={exportPDF} 
                    className="flex items-center gap-2 px-6 py-3 bg-white border-2 border-slate-100 rounded-2xl font-bold text-slate-600 hover:bg-slate-50 transition-all shadow-sm"
                  >
                    <Download className="w-4 h-4" />
                    PDF-Report
                  </button>
                </div>

                {/* 1. Dagrams First */}
                <div className="bg-slate-50/50 rounded-[2rem] p-4 sm:p-8 border border-slate-100">
                  <div className="h-72 sm:h-96 w-full">
                    <Chart 
                      type="bar"
                      options={{
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { 
                          legend: { position: "bottom", labels: { font: { weight: 'bold' } } },
                          tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            padding: 12,
                            titleFont: { size: 14, weight: 'bold' }
                          }
                        },
                        scales: { 
                          y: { 
                            beginAtZero: true, 
                            grid: { display: false },
                            ticks: { font: { weight: 'bold' } }
                          },
                          x: { grid: { display: false }, ticks: { font: { weight: 'bold' } } }
                        }
                      }}
                      data={{
                        labels: ["Jan", "Feb", "Mär", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dez"],
                        datasets: [
                          {
                            label: "Solar-Ertrag (kWh)",
                            data: [200, 350, 600, 900, 1200, 1300, 1250, 1100, 800, 500, 250, 150].map(v => v * (results.annualYield / 8600)),
                            backgroundColor: "rgba(16, 185, 129, 0.6)",
                            borderRadius: 8
                          },
                          {
                            label: "Verbrauch",
                            data: Array(12).fill(userData.annualConsumption / 12),
                            borderColor: "#0ea5e9",
                            borderWidth: 3,
                            type: "line",
                            pointRadius: 0,
                            tension: 0.4
                          }
                        ]
                      }}
                    />
                  </div>
                </div>

                {/* 2. Tiered Detail Sections */}
                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                  <div className="space-y-4">
                    <div className="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm transition-all hover:shadow-xl hover:shadow-slate-200/40">
                      <div className="flex items-center gap-4 mb-6">
                        <div className="p-3 bg-emerald-50 text-emerald-500 rounded-2xl">
                          <Euro className="w-6 h-6" />
                        </div>
                        <h4 className="text-xl font-black">Finanzielle Power</h4>
                      </div>
                      <div className="space-y-6">
                        <div className="flex justify-between items-center">
                          <span className="text-slate-500 font-bold">Ersparnis (20J)</span>
                          <span className="text-2xl font-black text-emerald-600">~{(results.annualSavings * 20).toLocaleString()} €</span>
                        </div>
                        <div className="h-3 bg-slate-100 rounded-full overflow-hidden">
                           <motion.div 
                             initial={{ width: 0 }}
                             animate={{ width: "100%" }}
                             transition={{ delay: 0.5, duration: 1 }}
                             className="h-full bg-gradient-to-r from-emerald-400 to-emerald-600" 
                           />
                        </div>
                        
                        <details className="group">
                          <summary className="flex items-center gap-2 text-sm font-black text-brand-primary cursor-pointer uppercase tracking-wider">
                             Details einblenden
                             <ChevronRight className="w-4 h-4 transition-transform group-open:rotate-90" />
                          </summary>
                          <div className="mt-4 pt-4 border-t border-slate-50 space-y-3 font-medium text-sm text-slate-600">
                             <div className="flex justify-between"><span>Einspeisevergütung</span><span>~{(results.annualYield * 0.082).toFixed(0)} € / J</span></div>
                             <div className="flex justify-between"><span>Netzbezug gespart</span><span>~{(userData.annualConsumption * results.autarchyRate / 100 * 0.35).toFixed(0)} € / J</span></div>
                             <div className="flex justify-between font-black text-slate-800"><span>Gesamtvorteil</span><span>~{results.annualSavings.toLocaleString()} € / J</span></div>
                          </div>
                        </details>
                      </div>
                    </div>
                  </div>

                  <div className="space-y-4">
                    <div className="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm transition-all hover:shadow-xl hover:shadow-slate-200/40">
                      <div className="flex items-center gap-4 mb-6">
                        <div className="p-3 bg-blue-50 text-blue-500 rounded-2xl">
                          <BarChart3 className="w-6 h-6" />
                        </div>
                        <h4 className="text-xl font-black">Energie-Check</h4>
                      </div>
                      <div className="space-y-6">
                        <div className="flex justify-between items-center">
                          <span className="text-slate-500 font-bold">Autarkie-Level</span>
                          <span className="text-2xl font-black text-brand-secondary">{results.autarchyRate.toFixed(1)}%</span>
                        </div>
                        <div className="h-3 bg-slate-100 rounded-full overflow-hidden">
                           <motion.div 
                             initial={{ width: 0 }}
                             animate={{ width: `${results.autarchyRate}%` }}
                             transition={{ delay: 0.7, duration: 1 }}
                             className="h-full bg-gradient-to-r from-blue-400 to-brand-secondary" 
                           />
                        </div>
                        
                        <details className="group">
                          <summary className="flex items-center gap-2 text-sm font-black text-brand-secondary cursor-pointer uppercase tracking-wider">
                             Mehr erfahren
                             <ChevronRight className="w-4 h-4 transition-transform group-open:rotate-90" />
                          </summary>
                          <div className="mt-4 pt-4 border-t border-slate-50 text-sm text-slate-600 font-medium leading-relaxed">
                            Mit Ihrem Speicher von {userData.storageSize} kWh überbrücken Sie die Abendstunden hocheffizient. Ihr Eigenverbrauch liegt bei <span className="text-brand-primary font-bold">{results.selfConsumptionRate.toFixed(1)}%</span>.
                          </div>
                        </details>
                      </div>
                    </div>
                  </div>
                </div>
              </motion.div>
            )}

            {step === 4 && (
              <motion.div 
                key="step4"
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                exit={{ opacity: 0, y: -20 }}
                className="space-y-12 relative z-10"
              >
                <div className="bg-slate-900 glass-dark rounded-[2.5rem] p-8 sm:p-12 text-white relative overflow-hidden shadow-2xl">
                  <div className="absolute top-0 right-0 w-96 h-96 bg-brand-primary/10 rounded-full blur-3xl -mr-48 -mt-48" />
                  
                  <div className="relative z-10 grid grid-cols-1 lg:grid-cols-5 gap-12 items-center">
                    <div className="lg:col-span-3 space-y-8">
                      <div className="inline-flex items-center gap-2 px-4 py-2 bg-white/10 rounded-2xl border border-white/10 backdrop-blur-md">
                        <div className="w-2 h-2 rounded-full bg-emerald-400 animate-pulse" />
                        <span className="text-xs font-black text-brand-primary tracking-widest uppercase">Bereit zur Umsetzung</span>
                      </div>
                      
                      <h2 className="text-4xl sm:text-5xl font-display font-black leading-tight">
                        Ihre persönliche <span className="text-brand-primary">Solar-Beratung</span>.
                      </h2>
                      
                      {loadingAi ? (
                        <div className="flex items-center gap-4 py-8">
                          <div className="w-10 h-10 border-4 border-white/10 border-t-brand-primary rounded-full animate-spin" />
                          <p className="text-slate-400 font-bold">Der AI Expert wertet Ihre Daten aus...</p>
                        </div>
                      ) : (
                        <div className="space-y-6">
                           <p className="text-xl text-slate-300 font-medium leading-relaxed italic opacity-90">
                            "{aiAdvice}"
                          </p>
                          <div className="flex flex-wrap gap-4 pt-4">
                            <div className="bg-white/5 px-4 py-2 rounded-xl border border-white/10 text-xs font-bold text-slate-400">#KostenneutralGarantie</div>
                            <div className="bg-white/5 px-4 py-2 rounded-xl border border-white/10 text-xs font-bold text-slate-400">#EchtzeitAnalyse</div>
                            <div className="bg-white/5 px-4 py-2 rounded-xl border border-white/10 text-xs font-bold text-slate-400">#RegionalExpertise</div>
                          </div>
                        </div>
                      )}
                    </div>
                    
                    <div className="lg:col-span-2 bg-white rounded-3xl p-8 text-slate-900 shadow-2xl relative">
                      <div className="space-y-6">
                        <div className="text-center">
                           <h4 className="text-xl font-black mb-2 tracking-tight">Angebot erhalten</h4>
                           <p className="text-slate-500 text-sm font-medium">Unverbindlich & regional.</p>
                        </div>
                        
                        <div className="space-y-4">
                          <div className="space-y-1.5">
                            <label className="text-[10px] font-black text-slate-400 uppercase ml-2">Vollständiger Name</label>
                            <input type="text" className="input-field" placeholder="z.B. Max Mustermann" />
                          </div>
                          <div className="space-y-1.5">
                            <label className="text-[10px] font-black text-slate-400 uppercase ml-2">E-Mail Adresse</label>
                            <input type="email" className="input-field" placeholder="name@beispiel.de" />
                          </div>
                          <button className="w-full py-4 bg-brand-primary hover:bg-emerald-600 text-white font-black rounded-2xl shadow-xl shadow-brand-primary/20 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3">
                            MEIN PROJEKT STARTEN
                            <ChevronRight className="w-5 h-5" />
                          </button>
                          <div className="flex flex-col items-center gap-2 pt-2">
                             <div className="flex gap-1">
                                {[1, 2, 3, 4, 5].map(i => <Sun key={i} className="w-3 h-3 text-amber-400 fill-current" />)}
                             </div>
                             <span className="text-[10px] font-bold text-slate-400">Bereits von 4.8/5 Kunden empfohlen.</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-8 px-4">
                   <div className="flex gap-4 items-start">
                      <div className="p-3 bg-slate-100 rounded-2xl">
                         <FileText className="w-6 h-6 text-slate-600" />
                      </div>
                      <div>
                         <h5 className="font-black text-lg">Wissenschaftliche Basis</h5>
                         <p className="text-sm text-slate-500 font-medium leading-relaxed">Wir nutzen Real-Daten des Deutschen Wetterdienstes für Ihre Prognosen.</p>
                      </div>
                   </div>
                   <div className="flex gap-4 items-start">
                      <div className="p-3 bg-slate-100 rounded-2xl">
                         <CheckCircle2 className="w-6 h-6 text-slate-600" />
                      </div>
                      <div>
                         <h5 className="font-black text-lg">Kein Spam Versprechen</h5>
                         <p className="text-sm text-slate-500 font-medium leading-relaxed">Ihre Daten werden nur für dieses eine Solar-Angebot verwendet.</p>
                      </div>
                   </div>
                </div>
              </motion.div>
            )}
          </AnimatePresence>

          <div className="flex flex-col sm:flex-row justify-between items-center mt-12 pt-8 gap-4 border-t border-slate-100 animate-in fade-in slide-in-from-bottom-4">
            <button
              onClick={handlePrev}
              disabled={step === 1}
              className={`order-2 sm:order-1 flex items-center gap-2 px-8 py-4 rounded-2xl font-bold transition-all ${
                step === 1 ? "opacity-0 pointer-events-none" : "text-slate-500 hover:bg-slate-100"
              }`}
            >
              <ChevronLeft className="w-5 h-5" />
              Zurück
            </button>
            
            {step < 4 ? (
              <button
                onClick={handleNext}
                className="order-1 sm:order-2 w-full sm:w-auto flex items-center justify-center gap-3 px-10 py-5 bg-slate-900 hover:bg-black text-white rounded-2xl font-black transition-all transform hover:scale-105 active:scale-95 shadow-xl shadow-slate-900/20 group relative overflow-hidden"
              >
                <span className="relative z-10 transition-colors">
                  {step === 1 ? "JETZT Ersparnis berechnen" : step === 3 ? "KI-Expertenrat anfordern" : "Konfiguration bestätigen"}
                </span>
                <ChevronRight className="w-5 h-5 relative z-10 transition-transform group-hover:translate-x-1" />
                <div className="absolute inset-0 bg-gradient-to-r from-brand-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity" />
              </button>
            ) : (
              <button
                onClick={() => setStep(1)}
                className="order-1 sm:order-2 w-full sm:w-auto flex items-center justify-center gap-2 px-10 py-5 bg-brand-primary text-white rounded-2xl font-black hover:shadow-2xl hover:shadow-brand-primary/30 transition-all transform hover:-translate-y-1"
              >
                Erneute Analyse starten
              </button>
            )}
          </div>
        </div>

        <footer className="mt-12 text-center text-slate-400 text-sm">
          <p>© 2024 SolarExpert Intelligence. Alle Berechnungen sind Richtwerte.</p>
          <div className="flex justify-center gap-6 mt-4">
            <a href="#" className="hover:text-brand-primary">Impressum</a>
            <a href="#" className="hover:text-brand-primary">Datenschutz</a>
            <a href="#" className="hover:text-brand-primary">Cookie-Einstellungen</a>
          </div>
        </footer>
      </div>
    </div>
  );
}
