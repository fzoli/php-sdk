# Rules

- This directory contains the entities of the whole application.
- Nothing else should be in this directory.
- Entities outside of this directory are ignored.

**Reason:**
AnnotationMetadataConfiguration is used so it search the classes in runtime. It must be fast.

# Note

We use Doctrine ORM's repository so there are no repository implementations in the code.
