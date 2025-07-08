Contributing to HelloWorldNG
Thank you for your interest in contributing to HelloWorldNG! This project is in the early, non-functional development stage, and we're excited to build a robust foundation with community support. HelloWorldNG is primarily a PHP (v8.2) project with some Node.js components and may incorporate select Laravel /illuminate packages as a minor aspect of the architecture. This guide outlines how to contribute effectively, including responsible use of AI-assisted coding to avoid low-quality or "hallucinated" code.
Getting Started
Prerequisites

PHP 8.2 and Composer for dependency management.
Node.js (v18 or higher recommended) and npm/yarn for frontend tooling.
Basic knowledge of Git and GitHub workflows.
[Optional: Familiarity with Laravel's /illuminate packages (e.g., illuminate/database) is a plus but not required.]

Setting Up the Project

Fork the repository: https://github.com/jfinstrom/helloworldng.
Clone your fork locally:git clone https://github.com/your-username/helloworldng.git

Navigate to the project directory:cd helloworldng

Install PHP dependencies:composer install

Install Node.js dependencies (if applicable):npm install

Create a new branch for your work:git checkout -b feature/your-feature-name

Contribution Guidelines
Code Contributions
We welcome code contributions but expect high-quality, intentional submissions aligned with the project's early-stage goals. Focus on modular, maintainable code that supports a flexible PHP and Node.js architecture.

Follow the Project Structure:
Adhere to organized directory structures (e.g., src/, config/, assets/).
Place Node.js-related code in appropriate folders (e.g., assets/js/ or scripts/).

Write Clear Code:
Use meaningful names for classes, methods, and variables (e.g., follow PSR-12 for PHP).
Add PHPDoc blocks for complex logic or public APIs.
Write code that is framework-agnostic where possible, unless specific /illuminate packages are used.

Test Your Code:
Include unit or integration tests using PHPUnit (e.g., tests/ directory).
Since the project is non-functional, mock dependencies or use in-memory databases (e.g., SQLite) for tests.

Avoid "Vibe Coding":
Do not submit untested, speculative, or "hallucinated" code (e.g., AI-generated code without review).
Ensure your code aligns with the project's goals and avoids overly complex or framework-specific patterns unless necessary.

Using AI-Assisted Coding
AI tools (e.g., GitHub Copilot, Grok) are welcome but must be used responsibly:

Review AI Output: Treat AI-generated code as a draft. Verify it aligns with project goals and is clean, functional code.
No Blind Commits: Do not commit AI-generated code without understanding, testing, and refining it.
Document AI Use: In your pull request, note if AI tools were used (e.g., "Used Copilot for initial class setup, manually optimized and tested").
PHP/Node.js Tips:
Ensure AI-generated code follows PSR-12 for PHP or ESLint for JavaScript.
If /illuminate packages are involved, validate proper usage (e.g., correct dependency injection).

Submitting a Pull Request (PR)

Push your changes to your fork:git push origin feature/your-feature-name

Open a PR against the main branch of jfinstrom/helloworldng.
In your PR description:
Explain the purpose of your changes.
Reference related issues (e.g., Fixes #123).
Note if AI tools were used and how you validated the code.

Ensure your PR passes automated checks (e.g., PHPStan, ESLint, or GitHub Actions CI, if set up).

Non-Code Contributions
We value contributions beyond code, including:

Writing documentation (e.g., updating README.md or creating API docs).
Reporting bugs or suggesting features via GitHub Issues.
Improving this CONTRIBUTING.md or other guides.
Suggesting improvements for PHP/Node.js integration or dependency management.

Code of Conduct
Be respectful and professional in all interactions. We follow the Contributor Covenant Code of Conduct.
Developer, Not Project Manager
Focus on development tasks rather than managing the project. For major changes or new features:

Open a GitHub Issue to discuss with maintainers.
Avoid proposing large-scale architectural changes unless coordinated with the core team.

Getting Help

Review the README.md for setup details.
Ask questions via GitHub Issues.
For AI-related questions, clarify how you validated AI outputs before seeking help.
For /illuminate package usage, refer to their respective READMEs on GitHub.

License
By contributing, you agree that your contributions will be licensed under the project's LICENSE.
Thank you for helping build HelloWorldNG!
