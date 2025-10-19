# Project Details for nextjs-project-2

This document outlines the key details of the data migration project from a WordPress database to a new Next.js application.

## Database Information

- **Source Database:** WordPress (`onfra_wordpress`)
- **Target Database:** MySQL (managed by Prisma)
- **WordPress Table Prefix:** `wpsw_`

## Prisma Schema

The `schema.prisma` file defines the data models for the new application. The primary model is `Blog`, which corresponds to the posts from the WordPress database.

### Blog Model

- `id`: Auto-incrementing integer (Primary Key)
- `title`: String
- `content`: Text (stores the full HTML content from WordPress)
- `mini_content`: Text (stores the content with HTML tags stripped)
- `max`: Integer (currently set to a constant value of `20`)
- `createdAt`: DateTime
- `updatedAt`: DateTime
- `cats`: Relation to `Cat` model
- `tags`: Relation to `Tag` model

## Data Transfer Script

The `scripts/transfer.ts` file is responsible for migrating the data.

### Process

1.  **Connects** to both the source WordPress database and the target Prisma-managed database.
2.  **Queries** the `wpsw_posts` table for all published posts.
3.  **Retrieves** associated categories and tags from the `wpsw_term_relationships`, `wpsw_term_taxonomy`, and `wpsw_terms` tables.
4.  **Strips HTML** from the `post_content` to create `mini_content`.
5.  **Creates** a new `Blog` record in the target database, populating all fields, including the new `max` and `mini_content` columns.
6.  **Associates** the new `Blog` record with its corresponding categories and tags.
