---
title: ReadMe
published: true
---

# Grav Helios Course Hub Skeleton

Give your course a clean, open home on the web – without building from scratch. This package, combined with the [Grav Premium Helios theme](https://getgrav.org/premium/helios), provides a ready-to-run companion site for one or more courses, with content you fully control. It includes [Grav CMS](https://getgrav.org), an open-source, flat-file CMS with no database required and a built-in browser-based Admin panel.

## Who This Is For

The Helios Course Hub is a **course companion site** – a place to organise and share course content, resources, schedules, and weekly materials alongside your existing LMS (Canvas, Moodle, Brightspace, etc.). It is not a learning management system and does not include enrolment, grade tracking, or student progress features.

It is well suited for educators and teams who want full control over their content, structure, and hosting, including:
- Individual educators wanting a clean, open companion site for one or more courses
- Teams hosting shared course content, reference guides, or topic indexes
- Anyone who wants full control over their content, structure, and hosting

## Why the Helios Course Hub
The Helios Course Hub gives you a modern, open, and fully controlled companion site that works alone or alongside any LMS – a dedicated home for your course content, resources, and schedules that you control completely.

- Ready in minutes – a complete, pre-configured package with demo content included
- Flexible – host one course or many from a single installation
- Yours – host it anywhere PHP runs, customise freely, and keep every word you write
- Open by design – optionally enable the built-in Git Sync and "Edit this Page" support
- Flat-file simplicity – your content is just Markdown files you own and control
- Support open source – your Grav Premium Helios theme purchase directly supports ongoing development of the open-source Grav CMS

## Quick Start

The skeleton is a **complete, ready-to-run package** – Grav CMS, the Helios Course Hub plugin, and demo content are all included. It defaults to a **single-course setup** with the top-level folders in `user/pages/` pre-configured and ready to use.

1. **Download and install** the [Grav Helios Course Hub Skeleton](https://github.com/paulhibbitts/grav-skeleton-helios-course-hub/releases/latest) package
2. **Enter your licenses** – enter your Helios and complimentary SVG Icons license keys (or import an existing license file), then install and activate the theme
3. **Edit your pages** in `user/pages/` – start with `10.home/` and work through the pre-built single-course sections
4. **Publish** – works on almost any Web Server, with PHP 7.3.6+, or run locally; no database required

For a multi-course setup, see the [Multi-Course Setup](#multi-course-setup) section below.

## Features

- Ready-to-use course companion website with the clean and modern Helios theme
- Support for single or multiple courses from one site
- Built-in shortcodes for embedding content (iFrames, Google Slides, PDFs, H5P, Embedly)
- Responsive iframe/video containers with 16:9 aspect ratio
- Embedly card support with automatic dark/light theme detection
- Alphabetical topics index with auto-generated A–Z navigation
- Git Sync plugin included for syncing site content with GitHub, Codeberg, or similar Git hosting service
- Automatic "Edit this Page" link option provided by the Helios Theme, with support for both GitHub and Codeberg repositories
- Customizable CSS and JavaScript via the bundled Helios Course Hub plugin
- Admin panel styling customizations (increased font sizes and toolbar icon scaling)

If you prefer not to write Markdown directly, the optional [Grav Premium Editor Pro](https://getgrav.org/premium/editor-pro) provides a visual block editor for editing pages.

## Git Sync & Open Editing

The skeleton includes the [Git Sync plugin](https://github.com/trilbymedia/grav-plugin-git-sync), which keeps your site content automatically in sync with a GitHub or Codeberg repository. This enables a full open-authoring workflow:

- Content editors can work directly in the Grav Admin or commit changes via Git
- The Helios Theme's **"Edit this Page"** option adds a link on each page that takes readers directly to the corresponding source file in your repository for quick edits or contributions

## Single Course Setup (Default)

This skeleton is pre-configured for a single-course setup – no changes needed. Just start editing your pages:

```
user/pages/
├── 10.home/
├── 20.essentials/
├── 30.modules/
├── 40.schedule/
├── 50.topics/
├── 60.resources/
├── 70.ux-techniques-guide/
├── 80.syllabus/
├── contact/
└── copyright/
```

If switching back from a multi-course setup, make the following changes:
1. Set the site home page to `10.home`
2. For the page `00.home-multicourse` set **Published** to `false`
3. Disable **Versioning** in Helios Theme settings

## Multi-Course Setup

To host multiple courses from one Grav installation, make the following changes:
1. Set the site home page to `00.home-multicourse`
2. For the page `00.home-multicourse` set **Published** to `true`
3. Enable **Versioning** in Helios Theme settings
4. Create versioned course directories (see folder naming below)

```
user/pages/
├── cpt-363-1/          # Course 1
│   ├── 10.home/
│   ├── 20.essentials/
│   ├── 30.modules/
│   └── ...
├── cpt-363-2/          # Course 2
│   └── ...
└── cpt-363-3/          # Course 3
    └── ...
```

## Multi-Course Folder Naming

Course version folders must start with one or more letters, followed by a number. An optional hyphen can separate the letters from the number. Additional version segments (separated by dots or hyphens) are supported.

**Valid names:** `cpt-363-1`, `course-1`, `course-section-1`, `course-section-2`

**Invalid names:** `01.course` (starts with a digit), `course` (no number), `1course` (starts with a digit)

The simplest convention is `course-1`, `course-2`, `course-3`, etc.

## Course List Page

Multi-course setups include a **Course List** page template (`courselist`) that automatically generates course cards from detected version folders. Each card displays:

- **Title** from the versioning labels in Helios theme settings
- **Icon** from the course root folder frontmatter (`icon` field)
- **Description** from the course root folder frontmatter (`description` field)

To customize a course card, add `icon` and `description` to the frontmatter of the course root folder's markdown file (e.g. `cpt-363-1/default.md`):

```yaml
---
title: CPT-363
icon: tabler/bulb.svg
description: A basic introduction to UI/UX design.
---
```

The number of cards per row can be set via `cards_per_row` (1–4) in the course list page frontmatter.

## Included Plugin: Helios Course Hub

Custom CSS, JavaScript and shortcodes for the Helios Course Hub theme, plus Admin panel styling.

### Frontend Assets
- **helios.css** – Theme styling (announcement blockquotes, heading typography, Font Awesome spacing, responsive containers)
- **helios.js** – Embedly dark/light theme support with automatic CDN loading

### Admin Assets
- **admin.css** – Increased Admin panel font sizes and toolbar icon scaling
- **admin.js** – Admin panel JavaScript customizations

### Shortcodes
- [raw]`[iframe url="..."]`[/raw] – Responsive iframe embed, 16:9 by default
- [raw]`[iframe url="..." ratio="4:3"]`[/raw] – Responsive iframe embed at 4:3 ratio
- [raw]`[googleslides url="..."]`[/raw] – Responsive Google Slides embed
- [raw]`[pdf url="..."]`[/raw] – PDF viewer via Google Docs
- [raw]`[pdf url="..." ratio="portrait"]`[/raw] – PDF viewer at portrait ratio (letter/A4)
- [raw]`[h5p url="..."]`[/raw] or [raw]`[h5p id="..."]`[/raw] – H5P interactive content
- [raw]`[embedly url="..."]`[/raw] – Embedly card with dark mode support
- [raw]`[topics]...[/topics]`[/raw] – Alphabetical topics index with auto-generated A–Z navigation, linked letters, and styled letter section labels

### Theme Detection

If the Helios theme is not installed, the plugin automatically falls back to the Quark theme, redirects visitors to the License Manager page, and displays a warning banner prompting you to enter your Helios License key and install Helios.

### Course Label Customization

The Course dropdown label can be customized in the plugin's `languages.yaml` — English and French are included by default.

## Requirements

- PHP >= 7.3.6
- Grav CMS >= 1.7.0
- [Grav Premium Helios Theme](https://getgrav.org/premium/helios) – one license per site ([Standard or Team](https://getgrav.org/premium/license))
- Shortcode Core plugin >= 5.0.0

## License

MIT – Hibbitts Design

<hr>

Want to no longer display this page on your site?
Go to **Helios Theme Settings > Appearance**, scroll down to the bottom of the page and delete the **Header Menu** item **ReadMe**.
