---
name: wordpress-performance-marketing
description: Optimize WordPress sites for performance marketing by combining UX/conversion optimization, content strategy, and technical SEO. Focuses on B2B contexts and the Owned-First methodology for reducing client acquisition costs through foundational improvements.
---

# WordPress Performance Marketing Skill

A comprehensive skill for optimizing WordPress websites across three critical dimensions: User Experience & Conversion, Content Strategy, and Technical SEO. Designed for performance marketers working in B2B contexts who want to reduce advertising dependency through owned channel optimization.

## Core Philosophy: Owned-First Methodology

Before diving into tactics, understand the strategic framework:

**Owned-First Principle**: Invest in foundational improvements to owned channels (website, organic search, content) BEFORE scaling paid advertising. This reduces cost-per-lead dramatically while building sustainable growth.

**The Three Pillars**:
1. **Technical Excellence** - Fast, accessible, crawlable sites that rank and convert
2. **Strategic Content** - Content mapped to customer journey stages with appropriate CTAs
3. **Conversion Architecture** - UX patterns that reduce friction and build trust

## When to Use This Skill

Trigger this skill when the user wants to:
- Audit or optimize a WordPress site for performance marketing
- Review content strategy for B2B conversion optimization
- Implement technical SEO improvements
- Analyze landing pages or blog posts
- Set up conversion tracking and measurement
- Create performance marketing documentation or reports
- Build WordPress sites with conversion-first architecture

## Part 1: Technical SEO Optimization

### On-Page SEO Standards

When analyzing or creating WordPress pages/posts, enforce these standards:

**Title Tags**:
- Maximum 60 characters (Google truncates at ~60)
- Include primary keyword naturally
- Pattern: `{Primary Keyword} | {Benefit/Modifier} | {Brand}`
- Example: "Customer Journey Audit | Reduce CPL by 80% | Hasim Üner"
- Avoid keyword stuffing - write for humans first

**Meta Descriptions**:
- Maximum 155 characters (Google truncates at ~155)
- Include a clear CTA or value proposition
- Use active voice and benefit-driven language
- Example: "Discover hidden conversion leaks in your B2B funnel. Our data-driven audit reveals where you're losing customers and how to fix it."

**Heading Structure**:
- ONE H1 per page (usually the page title)
- H1 should include primary keyword naturally
- Use H2-H6 for logical content hierarchy
- Don't skip heading levels (no H1 → H4)
- Each section should have descriptive headings

**URL Structure**:
- Short, descriptive, keyword-rich
- Use hyphens (not underscores) for word separation
- Remove stop words (the, a, an, of, etc.) when possible
- Example: `/customer-journey-audit` not `/the-customer-journey-audit-service`
- Avoid dates in URLs unless content is time-sensitive news

**Internal Linking**:
- 3-5 contextual internal links per blog post
- Link to cornerstone content (services, key resources)
- Use descriptive anchor text (not "click here")
- Prioritize links to conversion pages
- Create topic clusters: pillar content ↔ supporting articles

### Structured Data (Schema.org)

WordPress sites should implement appropriate structured data:

**Required for ALL sites**:
- Organization schema (logo, social profiles, contact info)
- WebPage schema (breadcrumbs)
- Article schema (for blog posts)

**For Service-Based Businesses (like consultancies)**:
- Service schema for each service offering
- LocalBusiness (if applicable)
- Review/Rating schema (for testimonials)

**For Case Studies**:
- Review schema with rating
- Service schema (what service was provided)

**Implementation in WordPress**:
- Use Schema Pro, Rank Math, or Yoast SEO plugins
- Validate with Google's Rich Results Test: https://search.google.com/test/rich-results
- Test regularly - schema can break with theme/plugin updates

### Core Web Vitals Targets

Google's Core Web Vitals are ranking factors. Enforce these thresholds:

**Largest Contentful Paint (LCP)**:
- Target: < 2.5 seconds
- Measures: Loading performance
- Common fixes: Optimize images, use CDN, implement caching, preload critical resources

**First Input Delay (FID) / Interaction to Next Paint (INP)**:
- FID Target: < 100ms
- INP Target: < 200ms
- Measures: Interactivity
- Common fixes: Minimize JavaScript, defer non-critical JS, optimize event handlers

**Cumulative Layout Shift (CLS)**:
- Target: < 0.1
- Measures: Visual stability
- Common fixes: Set explicit width/height on images/videos, reserve space for ads, avoid inserting content above existing content

**Testing Tools**:
- PageSpeed Insights: https://pagespeed.web.dev/
- Chrome DevTools Lighthouse
- WebPageTest: https://www.webpagetest.org/

### WordPress-Specific Performance Optimization

**Theme Selection**:
- Use lightweight themes (Blocksy, GeneratePress, Kadence)
- Avoid page builders when possible (Elementor/Divi add bloat)
- Check theme's PageSpeed score before choosing

**Plugin Audit**:
- Fewer plugins = better performance
- Deactivate and delete unused plugins
- Use quality plugins from reputable developers
- Avoid plugins that load assets on every page when only needed on one

**Image Optimization**:
- Use WebP format with JPEG fallback
- Implement lazy loading (native or plugin)
- Properly size images (don't serve 4000px images for 400px containers)
- Use srcset for responsive images
- Compress images (ShortPixel, Imagify, or TinyPNG)

**Caching Strategy**:
- Page caching: WP Rocket, W3 Total Cache, or LiteSpeed Cache
- Object caching: Redis or Memcached (if server supports)
- Browser caching: Set proper cache headers
- CDN: Cloudflare, BunnyCDN, or StackPath

**Database Optimization**:
- Regular cleanup of revisions, spam, transients
- Use WP-Optimize or similar
- Optimize database tables monthly
- Limit post revisions in wp-config.php

**Code-Level Optimization**:
- Minimize HTTP requests
- Concatenate and minify CSS/JS
- Remove query strings from static resources
- Disable emojis if not needed
- Disable embeds if not using
- Use async/defer for non-critical JavaScript

## Part 2: Content Strategy & Customer Journey Mapping

...existing content...

**Version**: 1.0
**Last Updated**: February 2026
**Focus**: B2B Performance Marketing, WordPress Optimization, Owned-First Methodology
