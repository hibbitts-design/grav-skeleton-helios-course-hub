# Grav Helios Course Hub Plugin

Give your course a modern, open home on the web – without building from scratch. Designed for use with the [Grav Premium Helios theme](https://getgrav.org/premium/helios) and the pre-configured [Grav Helios Course Hub Skeleton](https://github.com/hibbitts-design/grav-skeleton-helios-course-hub), providing custom CSS, JavaScript, shortcodes and enhanced Admin Panel readability.

## Screenshots

<p float="left">
  <a href="https://demo.hibbittsdesign.org/grav-helios-multi-course-hub/"><img alt="Grav Helios Course Hub, course list page" src="https://raw.githubusercontent.com/hibbitts-design/grav-skeleton-helios-course-hub/refs/heads/main/screenshot-1.png" width="49%"></a>&nbsp;<a href="https://demo.hibbittsdesign.org/grav-helios-multi-course-hub/cpt-363-1/home"><img alt="Grav Helios Course Hub, course page" src="https://raw.githubusercontent.com/hibbitts-design/grav-skeleton-helios-course-hub/refs/heads/main/screenshot-2.png" width="49%"></a>
</p>

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

The recommended starting point is the pre-configured [Grav Helios Course Hub Skeleton](https://github.com/hibbitts-design/grav-skeleton-helios-course-hub/releases/latest), which includes this plugin, demo content, and all required configuration out of the box.

1. **Download and install** the [Grav Helios Course Hub Skeleton](https://github.com/hibbitts-design/grav-skeleton-helios-course-hub/releases/latest) package
2. **Enter your licenses** – enter your Helios and complimentary SVG Icons license keys (or import an existing license file), then install and activate the theme

The skeleton comes pre-configured with demo content in `user/pages/cpt-363-1/` and is ready to run immediately.

To install the plugin manually, see the [Installation](#installation) and [Demo Content](#demo-content) sections below.

## Demo Content

The `_demo` folder contains a default Helios Course Hub site that can be used as a starting point:

- `00.courses/` – Courses homepage using the `course-list` template
- `cpt-363-1/` – First course (10.home, 20.essentials, 30.modules, 40.schedule, 50.topics, 60.resources, 70.ux-techniques-guide, 80.syllabus)
- `cpt-363-2/` – Second course with the same section structure
- `cpt-363-3/` – Third course with the same section structure

To use the demo content, copy the contents of `_demo/pages/` into your Grav `user/pages/` folder.

## Helios Theme Configuration

If you are not using the pre-configured [Grav Helios Course Hub Skeleton](https://github.com/hibbitts-design/grav-skeleton-helios-course-hub), add the following to `user/config/themes/helios.yaml` to configure course versioning and search:

```yaml
versioning:
  version_pattern: '/^[a-zA-Z]+-?\d+([.-]\d+)*$/i'
  labels:
    cpt-363-1: CPT-363-1
    cpt-363-2: CPT-363-2
    cpt-363-3: CPT-363-3
search:
  placeholder: 'Search course...'
```

If disabling the plugin, manually restore the following Helios theme defaults in `user/config/themes/helios.yaml`:

```yaml
versioning:
  version_pattern: '/^v?\d+(\.\d+)*$/'
  labels:
    v1: "v1 (Legacy)"
    v2: "v2 (Stable)"
    v3: "v3 (Latest)"
search:
  placeholder: 'Search documentation...'
```

## Installation

1. Copy the `helios-course-hub` folder into `user/plugins/`
2. The plugin is enabled by default via `helios-course-hub.yaml`

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

## Shortcodes

- `[iframe url="..."]` – Responsive iframe embed, 16:9 by default
- `[iframe url="..." ratio="4:3"]` – Responsive iframe embed at 4:3 ratio
- `[googleslides url="..."]` – Responsive Google Slides embed, 16:9 by default
- `[googleslides url="..." ratio="4:3"]` – Responsive Google Slides embed at 4:3 ratio
- `[pdf url="..."]` – PDF viewer via Google Docs, 16:9 by default
- `[pdf url="..." ratio="4:3"]` – PDF viewer at 4:3 ratio
- `[pdf url="..." ratio="portrait"]` – PDF viewer at portrait ratio (letter/A4)
- `[h5p url="..."]` – H5P interactive content via full embed URL
- `[h5p id="..."]` – H5P interactive content via Content ID (requires H5P Content Embed Source URL to be set in plugin settings)
- `[embedly url="..."]` – Embedly card with dark mode support
- `[topics]...[/topics]` – Alphabetical topics index with auto-generated A–Z navigation, linked letters, and styled letter section labels

### Topics Shortcode

The `[topics]` shortcode wraps alphabetically organized content and auto-generates a full A–Z index at the top of the page. Letters with entries are rendered as anchor links; letters without entries are shown as dimmed plain text.

```markdown
# Topics

[topics]
## A
[Agile UX](../modules/module-02)
## D
[Design Ethics](../modules/module-02)
[Design Thinking](../modules/module-01)
[/topics]
```

## Courses Homepage

The `course-list` page template automatically generates course cards from detected version folders. Each card displays a title, icon and description sourced from the course root folder's markdown file (e.g. `cpt-363-1/course.md`):

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

## Course Folder Naming

Course folders must start with one or more letters followed by a number. An optional hyphen can separate letters from the number, and additional version segments (separated by dots or hyphens) are supported.

**Valid:** `cpt-363-1`, `course-1`, `course-section-2`  
**Invalid:** `01.course` (starts with a digit), `course` (no number), `1course` (starts with a digit)

## Course Label Customization

The Course dropdown label and its default fallback can be customized in `languages.yaml`. English and French are included:

```yaml
en:
  PLUGIN_HELIOS_COURSE_HUB:
    COURSE_LABEL: Course
    COURSE_LATEST_LABEL: default

fr:
  PLUGIN_HELIOS_COURSE_HUB:
    COURSE_LABEL: Cours
    COURSE_LATEST_LABEL: défaut
```

To customize the label or add a language, update the relevant block in `languages.yaml`.

## Plugin Settings

The following settings are available in the Admin panel under **Plugins → Helios Course Hub**:

| Setting | Default | Description |
|---------|---------|-------------|
| Show Site Logo Icon | Enabled | Show or hide the icon square next to the Logo Text in the header when no logo image is set |
| Site Logo Icon | _(empty)_ | Tabler icon path for the site logo icon square (e.g. `tabler/book.svg`). Leave empty to use the default icon. Only applies when Show Site Logo Icon is enabled |
| Single Course Site Logo Link | Courses Home Page | Choose where the site Logo Text and icon link navigates: **Courses Home Page** or **First Page of Only Listed Course** (navigates to the first page of the course when only one course is active) |
| Git Server | `github.com` | Git hosting service for the Helios GitHub Integration (`github.com` or `codeberg.org`) |
| H5P Content Embed Source URL | `https://h5p.org/h5p/embed/` | Base URL for H5P embeds via Content ID (used with `[h5p id="..."]`) |

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
