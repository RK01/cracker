# Competitive Cracker — Bootstrap 5 Edition

https://future-forge-info.lovable.app/ (demo by) 


Static website built with Bootstrap 5, plain HTML, CSS, and vanilla JavaScript. No build step required.

## How to run
1. Unzip the folder.
2. Open `index.html` in any modern browser, OR
3. Serve with any static server (recommended):
   ```bash
   # Python
   python3 -m http.server 8000
   # then open http://localhost:8000
   ```

## Pages included
- index.html              — Home (carousel, courses, faculty, notices, FAQ, gallery)
- about.html              — About Us
- vision-mission.html     — Vision & Mission
- category-iit-jee.html   — IIT JEE category landing
- category-neet.html      — NEET category landing
- course-jee-mains.html, course-jee-advanced.html
- course-neet-2-year.html, course-neet-1-year.html
- course-ca-foundation.html, course-clat.html, course-cuet.html
- course-12th-dropper.html
- academic.html           — Class 6–12 academic programs
- olympiad.html           — Olympiad registration form
- faculty.html            — Faculty listing
- admissions.html         — Admissions process & dates
- gallery.html            — Photos & videos with lightbox
- contact.html            — Contact form & address
- register.html           — Student registration with CAPTCHA + state/city dependent dropdown
- thank-you.html          — Post-registration credentials

## Features
- Bootstrap 5.3 + Bootstrap Icons (CDN)
- Responsive on mobile, tablet, desktop
- Image carousel on home page
- Course detail pages with sticky sidebar
- Registration form with:
  - CAPTCHA validation
  - State → City dependent dropdown
  - LocalStorage data save (no backend required)
  - Auto-generated username & password on Thank-You page
- Gallery with lightbox modal
- Accordion FAQs, dropdown navigation
- Back-to-top button

## Folder structure
```
/

├── index.html, about.html, ... (all pages)
├── css/style.css
├── js/script.js
└── img/(folder) and images/(folder) (all images)
```

## Customization
- Colors are CSS variables in `css/style.css` (search for `--cc-primary`, `--cc-gold`).
- Add or edit registration data: open browser console → `localStorage.getItem('cc_registrations')`.
- To connect a real backend (PHP/Node), point the form `action` to your API endpoint and remove the JS preventDefault in `js/script.js`.

© 2025 Competitive Cracker
