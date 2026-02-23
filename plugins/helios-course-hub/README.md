# Grav Helios Course Hub Plugin

Give your course a clean, open home on the web – without building from scratch. Designed for use with the pre-configured [Grav Helios Course Hub Skeleton](https://github.com/paulhibbitts/grav-skeleton-helios-course-hub), providing custom CSS, JavaScript, shortcodes and enhanced Admin Panel readability.

![](screenshot-1.png)
Figure 1. Example Grav Helios Course Hub website, with a single course.

![](screenshot-2.png)
Figure 2. Example Grav Helios Course Hub website, with multiple courses.

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

The recommended starting point is the pre-configured [Grav Helios Course Hub Skeleton](https://github.com/paulhibbitts/grav-skeleton-helios-course-hub/releases/latest), which includes this plugin, demo content, and all required configuration out of the box.

1. **Download and install** the [Grav Helios Course Hub Skeleton](https://github.com/paulhibbitts/grav-skeleton-helios-course-hub/releases/latest) package
2. **Enter your licenses** – enter your Helios and complimentary SVG Icons license keys (or import an existing license file), then install and activate the theme

The skeleton defaults to a **single-course setup** – the top-level folders in `user/pages/` are pre-configured and ready to use.

To install the plugin manually, see the [Installation](#installation) and [Demo Content](#demo-content) sections below.

## Demo Content

The `_demo` folder contains a default Helios Course Hub site that can be used as a starting point. It includes two layouts:

**Single-course site** (`_demo/pages/`):
- `10.home/` – Course home page with weekly content cards
- `20.essentials/` – Essential course links and resources
- `30.modules/` – Weekly modules (Welcome + Modules 01–13), each with a header image
- `40.schedule/` – Course schedule
- `50.topics/` – Topics index
- `60.resources/` – Resource list
- `70.ux-techniques-guide/` – UX techniques reference guide
- `80.syllabus/` – Course syllabus
- `contact/` – Contact page
- `copyright/` – Copyright notice

**Multi-course site** (`_demo/pages/`):
- `00.home-multicourse/` – Course list home page using the `courselist` template
- `cpt-363-1/` – First course with the same section structure as the single-course layout
- `cpt-363-2/` – Second course with the same section structure as the single-course layout
- `cpt-363-3/` – Third course with the same section structure as the single-course layout

To use the demo content, copy the contents of `_demo/pages/` into your Grav `user/pages/` folder.

## Helios Theme Configuration

If you are not using the pre-configured [Grav Helios Course Hub Skeleton](https://github.com/paulhibbitts/grav-skeleton-helios-course-hub), add the following to `user/config/themes/helios.yaml` to configure course versioning and search:

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

- Course List page template with auto-generated course cards
- Built-in shortcodes for embedding content (iFrames, Google Slides, PDFs, H5P, Embedly)
- Embedly card support with automatic dark/light theme detection
- Enhanced Admin Panel readability (increased font sizes and toolbar icon scaling)
- Automatic theme detection with fallback to Quark if Helios is not installed
- Overrides the Helios "Version" label to "Course" for multi-course setups — customizable via `languages.yaml`
- Git Sync plugin included in the skeleton for syncing site content with a GitHub or Codeberg repository
- Automatic "Edit this Page" link option provided by the Helios Theme

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

The `[topics]` shortcode wraps alphabetically organised content and auto-generates a full A–Z index at the top of the page. Letters with entries are rendered as anchor links; letters without entries are shown as dimmed plain text.

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

## Course List Page

The `courselist` page template automatically generates course cards from detected version folders. Each card displays a title, icon and description sourced from the course root folder's markdown file (e.g. `cpt-363-1/default.md`):

```yaml
---
title: CPT-363
icon: tabler/bulb.svg
description: A basic introduction to UI/UX design.
---
```

The number of cards per row can be set via `cards_per_row` (1–4) in the course list page frontmatter.

## Multi-Course Folder Naming

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

## Requirements

- PHP >= 7.3.6
- Grav CMS >= 1.7.0
- [Grav Premium Helios Theme](https://getgrav.org/premium/helios) – one license per site ([Standard or Team](https://getgrav.org/premium/license))
- Shortcode Core plugin >= 5.0.0

## License

MIT – Hibbitts Design
