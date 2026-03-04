---
title: ReadMe
published: true
---

# Grav Helios Course Hub Skeleton

Give your course a modern, open home on the web – without building from scratch. This package, combined with the [Grav Premium Helios theme](https://getgrav.org/premium/helios), provides a ready-to-run companion site for one or more courses, with content you fully control. It includes [Grav CMS](https://getgrav.org), an open-source, flat-file CMS with no database required and a built-in browser-based Admin panel.

## Who This Is For

The Helios Course Hub is a **course companion site** – a place to organize and share course content, resources, schedules, and weekly materials alongside your existing LMS (Canvas, Moodle, Brightspace, etc.). It is not a learning management system and does not include enrollment, grade tracking, or student progress features.

It is well suited for educators and teams who want full control over their content, structure, and hosting, including:
- Individual educators wanting a clean, open companion site for one or more courses
- Teams hosting shared course content, reference guides, or topic indexes
- Anyone who wants full control over their content, structure, and hosting

## Why the Helios Course Hub
The Helios Course Hub gives you a modern, open, and fully controlled companion site that works alone or alongside any LMS – a dedicated home for your course content, resources, and schedules that you control completely.

- Ready in minutes – a complete, pre-configured package with demo content included
- Flexible – host one course or many from a single installation
- Yours – host it anywhere PHP runs, customize freely, and keep every word you write
- Open by design – optionally enable the built-in Git Sync and "Edit this Page" support
- Flat-file simplicity – your content is just Markdown files you own and control
- Support open source – your Grav Premium Helios theme purchase directly supports ongoing development of the open-source Grav CMS

## Quick Start

The skeleton is a **complete, ready-to-run package** – Grav CMS, the Helios Course Hub plugin, and demo content are all included. The home page is a **Courses** listing that shows all active courses – by default, just `cpt-363-1/`.

1. **Download and install** the [Grav Helios Course Hub Skeleton](https://github.com/hibbitts-design/grav-skeleton-helios-course-hub/releases/latest) package
2. **Enter your licenses** – enter your Helios and complimentary SVG Icons license keys (or import an existing license file), then install and activate the theme
3. **Edit your pages** in `user/pages/cpt-363-1/` – start with `10.home/` and work through the pre-built course sections
4. **Publish** – works on almost any Web Server, with PHP 7.3.6+, or run locally; no database required

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
- Course label with optional icon automatically displayed in the sidebar when multiple courses are active, linking to the first page of the current course
- Show or hide the site logo icon square next to the Logo Text in the header, with optional custom Tabler icon
- Configurable single course site logo link targeting the Courses Home Page or First Page of Only Listed Course
- Per-course favicon support – upload a `favicon.*` file to a course root page's media to override the site favicon for that course

If you prefer not to write Markdown directly, the optional [Grav Premium Editor Pro](https://getgrav.org/premium/editor-pro) provides a visual block editor for editing pages.

## Git Sync & Open Editing

The skeleton includes the [Git Sync plugin](https://github.com/trilbymedia/grav-plugin-git-sync), which keeps your site content automatically in sync with a GitHub or Codeberg repository. This enables a full open-authoring workflow:

- Content editors can work directly in the Grav Admin or commit changes via Git
- The Helios Theme's **"Edit this Page"** option adds a link on each page that takes readers directly to the corresponding source file in your repository for quick edits or contributions

## Course Setup

All course content lives in course folders within `user/pages/`. The skeleton ships with three pre-configured course folders and a `00.courses/` homepage that lists all visible courses as cards.

```
user/pages/
├── 00.courses/                  # Courses homepage
├── cpt-363-1/                   # Course 1 (published by default)
│   ├── 10.home/
│   ├── 20.essentials/
│   ├── 30.modules/
│   ├── 40.schedule/
│   ├── 50.topics/
│   ├── 60.resources/
│   ├── 70.ux-techniques-guide/
│   └── 80.syllabus/
├── cpt-363-2/                   # Course 2 (unpublished by default)
├── cpt-363-3/                   # Course 3 (unpublished by default)
├── contact/
└── readme/
```

By default, only `cpt-363-1/` is published, so the Courses homepage shows a single course card – a clean starting point for a one-course site. To activate additional courses, set **Published** to **Yes** in each course folder's root page. The Course Dropdown appears automatically once more than one course is published, and hides automatically when only one course is active.

### Showing and Hiding Courses

In the Admin panel, open the course folder's root page (e.g. `cpt-363-2`) and set **Published** to **Yes** to show or **No** to hide the course.

> [!TIP]
> When multiple courses are published, the Course Dropdown is useful while building and testing content, but students may find the Courses homepage is sufficient. Once content is finalized, you can hide this dropdown by setting **Show Version Dropdown** to **No** in the Helios Theme settings.

## Course Folder Naming

Course folders must start with one or more letters, followed by a number. An optional hyphen can separate the letters from the number. Additional version segments (separated by dots or hyphens) are supported.

**Valid names:** `cpt-363-1`, `course-1`, `course-section-1`, `course-section-2`

**Invalid names:** `01.course` (starts with a digit), `course` (no number), `1course` (starts with a digit)

The simplest convention is `course-1`, `course-2`, `course-3`, etc.

## Courses Homepage

The **Courses** homepage uses the `course-list` template to automatically generate course cards from detected course folders. Each card displays:

- **Title** from the versioning labels in Helios theme settings
- **Icon** from the course root folder frontmatter (`icon` field)
- **Description** from the course root folder frontmatter (`description` field)

To customize a course card, add `icon` and `description` to the frontmatter of the course root folder's markdown file (e.g. `cpt-363-1/course.md`):

```yaml
---
title: CPT-363
icon: tabler/bulb.svg
description: A basic introduction to UI/UX design.
---
```

The `card_icon` field set on the course-list page also serves as the **default sidebar course label icon** when a course has no `icon` of its own.

The number of cards per row can be set via `cards_per_row` (1–4) in the course list page frontmatter.

Page content written in the `course-list.md` file appears above the course cards by default. To also display content **below** the cards, add `===` on its own line as a delimiter:

```markdown
This text appears above the course cards.

===

This text appears below the course cards.
```

If no `===` delimiter is present, all content renders above the cards as normal.

## Included Plugin: Helios Course Hub

Custom CSS, JavaScript and shortcodes for the Helios Course Hub theme, plus Admin panel styling.

### Plugin Settings

The following settings are available in the Admin panel under **Plugins → Helios Course Hub**:

| Setting | Default | Description |
|---------|---------|-------------|
| Show Site Logo Icon | Enabled | Show or hide the icon square next to the Logo Text in the header when no logo image is set |
| Site Logo Icon | _(empty)_ | Tabler icon path for the site logo icon square (e.g. [raw]`tabler/book.svg`[/raw]). Leave empty to use the default icon. Only applies when Show Site Logo Icon is enabled |
| Single Course Site Logo Link | Courses Home Page | Choose where the site Logo Text and icon link navigates: **Courses Home Page** or **First Page of Only Listed Course** (navigates to the first page of the course when only one course is active) |
| Git Server | `github.com` | Git hosting service for the Helios GitHub Integration (`github.com` or `codeberg.org`) |
| H5P Content Embed Source URL | `https://h5p.org/h5p/embed/` | Base URL for H5P embeds via Content ID (used with [raw]`[h5p id="..."]`[/raw]) |

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

If the Helios theme is not installed, the plugin automatically falls back to the Quark theme so the frontend site remains viewable. In the Admin panel, it redirects to the License Manager page and displays a warning banner prompting you to enter your Helios and SVG-Icons license key and install Helios.

### Course Label Customization

The Course dropdown label can be customized in the plugin's `languages.yaml` — English and French are included by default.

## Requirements

- PHP >= 7.3.6
- Grav CMS >= 1.7.0
- [Grav Premium Helios Theme](https://getgrav.org/premium/helios) – one license per site ([Standard or Team](https://getgrav.org/premium/license))

## Support

### Contact and Support
- Follow [@hibbittsdesign@mastodon.social](https://mastodon.social/@hibbittsdesign) on Mastodon for updates
- 👩🏻‍💻🧑🏻‍💻 Join the [Grav Discord](https://chat.getgrav.org) and often find me there
- Add a ⭐️ [star on GitHub](https://github.com/hibbitts-design/grav-skeleton-helios-course-hub) to the Helios Course Hub project repository
- For bugs or feature requests, [open an issue](https://github.com/hibbitts-design/grav-skeleton-helios-course-hub/issues) on GitHub

### Professional Services

By leveraging his extensive UX design expertise and systems-oriented approach, Paul helps teams and individuals utilize open content in education and publication settings. Professional services include user experience and workflow consulting, premium support subscriptions, workshops, and custom development. Interested? Send a note to [paul@hibbittsdesign.org](mailto:paul@hibbittsdesign.org).

## License

MIT – Hibbitts Design

> [!TIP]
> Want to no longer display this page on your site? Go to **Helios Theme Settings > Appearance**, scroll down to the bottom of the page and delete the **Header Menu** item **ReadMe**.
