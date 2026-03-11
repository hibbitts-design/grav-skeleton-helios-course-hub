# Grav Helios Course Hub Skeleton

Give your course a modern, open home on the web – without building from scratch. This package, combined with the [Grav Premium Helios theme](https://getgrav.org/premium/helios), provides a ready-to-run companion site for one or more courses, with content you fully control. It includes [Grav CMS](https://getgrav.org), an open-source, flat-file CMS with no database required and a built-in browser-based Admin panel. Your Helios theme purchase directly supports ongoing development of the open-source Grav CMS.

## Screenshots

<p float="left">
  <a href="https://demo.hibbittsdesign.org/grav-helios-multi-course-hub/"><img alt="Grav Helios Course Hub, course list page" src="https://raw.githubusercontent.com/hibbitts-design/grav-skeleton-helios-course-hub/refs/heads/main/screenshot-1.png" width="49%"></a>&nbsp;<a href="https://demo.hibbittsdesign.org/grav-helios-multi-course-hub/cpt-363-1/home"><img alt="Grav Helios Course Hub, course page" src="https://raw.githubusercontent.com/hibbitts-design/grav-skeleton-helios-course-hub/refs/heads/main/screenshot-2.png" width="49%"></a>
</p>

## When is Grav Helios Course Hub a Good Candidate?

Grav Helios Course Hub often works really well when you:

- Want a visually refined, permanent companion site for one or more courses alongside your existing LMS and have access to a Web server
- Want a fully designed, ready-to-use course site without custom design or coding work
- Want to support multiple courses from a single installation with automatic course switching
- Need context-aware search — automatically scoped to all courses from the Courses homepage, or narrowed to the current course when browsing within it
- Want flexible editing options — browser-based Admin panel with Markdown by default and an optional visual block editor
- Need multi-user editing with role-based access rights for team-managed course content
- Need rich content embedding (H5P, iFrames, Google Slides, PDFs, Embedly) without coding
- Value keeping content in portable Markdown files with full ownership and hosting control
- Can optionally extend with custom branding — logos, colours, and styling — when a more distinctive look is needed

Other publishing tools might be better candidates when you:

- Need zero-server, instant publishing directly from GitHub without any hosting setup
- Require real LMS features such as enrollment, grade tracking, or student progress monitoring
- Need complex user management, approval workflows, or interactive features (contact forms, booking systems, user accounts)
- Need a large ecosystem of themes and plugins beyond what Grav currently offers
- Prefer fully visual drag-and-drop page builders over Markdown-based editing

Still unsure? Grav Helios Course Hub is designed for easy entry — install the skeleton package on almost any Web server, replace the demo content with your own, and your course site is ready. Your content stays in portable Markdown files you own completely. For quick, zero-setup publishing directly from a GitHub or Codeberg repository without a Web server, explore [Docsify-This](https://docsify-this.net).

## Quick Start

The skeleton is a **complete, ready-to-run package** – Grav CMS, the Helios Course Hub plugin, and demo content are all included. The home page is a **Courses** listing that shows all active courses – by default, just `cpt-363-1/`.

1. **Download and install** the [Grav Helios Course Hub Skeleton](https://github.com/hibbitts-design/grav-skeleton-helios-course-hub/releases/latest) package
2. **Enter your licenses** – your Helios and complimentary SVG Icons license keys (or import an existing license file), then install and activate the theme
3. **Edit your pages** in `user/pages/cpt-363-1/` – start with `10.home/` and work through the pre-built course sections
4. **Publish** – works on almost any Web server, with PHP 7.3.6+, or run locally; no database required

## Features

### Site Identity
- Show or hide the site logo icon square next to the Logo Text in the header, with optional custom Tabler icon
- Configurable single course site logo link targeting the Courses Home Page or First Page of Only Listed Course
- Course label with optional icon automatically displayed in the sidebar when multiple courses are published, linking to the first page of the current course
- Per-course favicon support – upload a `favicon.*` file to a course root page's media to override the site favicon for that course

### Course Cards
- Optional course card images – upload an image to a course root page's media and set `image` in frontmatter to display it on the course card, with a choice of side thumbnail or full-width top layout
- Optional course instructor(s) – set `instructor` in frontmatter to display instructor name(s) below the description on the course card
- Optional course badge – set `badge_label` and `badge_color` in frontmatter to display a status badge (e.g. "Coming Soon", "New", "Archived") on the course card

### Course Content
- Alphabetical topics index with auto-generated A–Z navigation
- Announcement shortcode – display a styled notice on any course page, with optional custom title and color type
- Configurable chapter page description line limit – set the maximum number of lines shown per card description on Chapter template pages (the Modules section uses this template) site-wide via the Helios Course Hub plugin settings (2 default, 3, or no limit)

### Embedding & Shortcodes
- Built-in shortcodes for embedding content (iFrames, Google Slides, PDFs, H5P, Embedly)
- Responsive iframe/video containers with 16:9 aspect ratio
- Embedly card support with automatic dark/light theme detection

### Authoring & Customization
- Git Sync plugin included for syncing site content with GitHub, Codeberg, or similar Git hosting service
- Automatic "Edit this Page" link option provided by the Helios Theme (skeleton default: 'View Page Markdown', linking to the Markdown source file on GitHub or Codeberg), with support for both GitHub and Codeberg repositories
- Customizable CSS and JavaScript via the bundled Helios Course Hub plugin
- Admin panel styling customizations (increased font sizes and toolbar icon scaling)
- Page Table of Contents template (`default-toc`) – set `template: default-toc` in any page's frontmatter to display a right-column Table of Contents alongside the content

## Course Setup

All course content lives in course folders within `user/pages/`. The skeleton ships with three pre-configured course folders and a `00.courses/` homepage that lists all visible courses as cards.

```
user/pages/
├── 00.courses/                  # Courses homepage
│   └── course-list.md           # Course list settings and default card values
├── cpt-363-1/                   # Course 1 (published by default)
│   ├── course.md                # Course settings (icon, image, instructor, badge)
│   ├── 10.home/
│   ├── 20.essentials/
│   ├── 30.modules/
│   ├── 40.schedule/
│   ├── 50.topics/
│   ├── 60.resources/
│   ├── 70.ux-techniques-guide/
│   └── 80.syllabus/
├── cpt-363-2/                   # Course 2 (same structure, unpublished by default)
├── cpt-363-3/                   # Course 3 (same structure, unpublished by default)
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

The **Courses** homepage uses the `course-list` template to automatically generate course cards from detected course folders.

### Courses List Page

The `course-list.md` frontmatter controls the list layout and sets default values for all course cards. These fields can be set in the Admin Panel by opening the Courses homepage.

| Field | Default | Description |
|-------|---------|-------------|
| `cards_per_row` | `1` | Number of course cards per row (1–2) |
| `card_icon` | — | Default icon for all course cards (Tabler icon path); also used as the sidebar course label icon when a course has no `icon` of its own |
| `card_image_layout` | `side` | Image layout: `side` (left thumbnail) or `top` (full-width above content) |
| `card_description_lines` | `3` | Maximum description lines per card (2, 3, or 0 for no limit) |

Page content written in `course-list.md` appears above the course cards by default. To also display content **below** the cards, add `===` on its own line as a delimiter:

```markdown
This text appears above the course cards.

===

This text appears below the course cards.
```

If no `===` delimiter is present, all content renders above the cards as normal.

### Course Page

Each course folder contains a `course.md` file with frontmatter that controls the course card display. These fields can be set in the Admin Panel by opening the course's root page.

| Field | Description |
|-------|-------------|
| `icon` | Tabler icon path (e.g. `tabler/bulb.svg`); overrides the `card_icon` default from `course-list.md` |
| `description` | Course description shown on the card |
| `instructor` | Optional instructor name(s) shown below the description |
| `badge_label` | Optional status badge label (e.g. `Coming Soon`, `New`, `Archived`) |
| `badge_color` | Optional badge colour (`yellow`, `green`, `red`, etc.) |
| `image` | Optional card image filename (upload to the course's media folder) |

```yaml
---
icon: tabler/bulb.svg
description: A basic introduction to UI/UX design.
instructor: Jane Smith & John Doe
badge_label: Coming Soon
badge_color: yellow
image: banner.jpg
---
```

To display a card image, upload an image file to the course root page's media folder and set `image` in the frontmatter to the filename. Omit the field (or leave it empty) for no image.

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

## Git Sync & Open Editing

The skeleton includes the [Git Sync plugin](https://github.com/trilbymedia/grav-plugin-git-sync), which keeps your site content automatically in sync with a GitHub or Codeberg repository. This enables a full open-authoring workflow:

- Content editors can work directly in the Grav Admin or commit changes via Git
- The Helios Theme's **"Edit this Page"** option adds a 'View Page Markdown' link on each page, taking readers directly to the Markdown source file in your repository

If you prefer not to write Markdown directly, the optional [Grav Premium Editor Pro](https://getgrav.org/premium/editor-pro) provides a visual block editor for editing pages.

## Included Plugin: Helios Course Hub

Custom CSS, JavaScript and shortcodes for the Helios Course Hub theme, plus Admin panel styling. If the Helios theme is not installed, the plugin automatically falls back to the Quark theme so the frontend site remains viewable, redirecting to the License Manager page in the Admin panel.

### Plugin Settings

The following settings are available in the Admin panel under **Plugins → Helios Course Hub**:

| Setting | Default | Description |
|---------|---------|-------------|
| Show Site Logo Icon | Enabled | Show or hide the icon square next to the Logo Text in the header when no logo image is set |
| Site Logo Icon | _(empty)_ | Tabler icon path for the site logo icon square (e.g. `tabler/book.svg`). Leave empty to use the default icon. Only applies when Show Site Logo Icon is enabled |
| Single Course Site Logo Link | Courses Home Page | Choose where the site Logo Text and icon link navigates: **Courses Home Page** or **First Page of Only Listed Course** (navigates to the first page of the course when only one course is active) |
| Show Plugin Credits | Enabled | Show or hide the "Built with Grav · Helios · Helios Course Hub" attribution line in the footer |
| Description Line Limit | 2 lines | Maximum number of lines shown per card description on Chapter template pages; the Modules section uses this template (2, 3, or no limit) |
| Git Server | `github.com` | Git hosting service for the Helios GitHub Integration (`github.com` or `codeberg.org`) |
| H5P Content Embed Source URL | `https://h5p.org/h5p/embed/` | Base URL for H5P embeds via Content ID (used with `[h5p id="..."]`) |

### Templates
- **default-toc** – Content page template with a right-column Table of Contents. Set `template: default-toc` in any page's frontmatter to enable. Requires the page-toc plugin (included).

### Assets
- **helios.css** – Theme styling (announcement blockquotes, heading typography, Font Awesome spacing, responsive containers)
- **helios.js** – Embedly dark/light theme support with automatic CDN loading
- **admin.css** – Increased Admin panel font sizes and toolbar icon scaling
- **admin.js** – Admin panel JavaScript customizations

### Shortcodes
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
- `[announcement]...[/announcement]` – Styled announcement notice (default: Important/purple), supports Markdown content
- `[announcement title="..." type="..."]...[/announcement]` – With optional custom title and type (`note`, `tip`, `important`, `warning`, `caution`)

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