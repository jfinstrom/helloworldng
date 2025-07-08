

# Contributing to HelloWorldNG

Thank you for your interest in contributing to [HelloWorldNG](https://github.com/jfinstrom/helloworldng)! This project is in the early, non-functional development stage, and we're excited to build a robust foundation with community support. HelloWorldNG is primarily a PHP (v8.2) project with some Node.js components and may incorporate select Laravel `/illuminate` packages as a minor aspect of the architecture. This guide outlines how to contribute effectively, including responsible use of AI-assisted coding to avoid low-quality or "hallucinated" code.

## Getting Started

### Prerequisites
- **PHP 8.2** and Composer for dependency management.
- **Node.js** (v18 or higher recommended) and npm/yarn for frontend tooling.
- Basic knowledge of Git and GitHub workflows.
- [Optional: Familiarity with Laravel's `/illuminate` packages (e.g., `illuminate/database`) is a plus but not required.]
- [Optional: Docker, if used for local development setup.]

### Setting Up the Project
1. Fork the repository: [https://github.com/jfinstrom/helloworldng](https://github.com/jfinstrom/helloworldng).
2. Clone your fork locally:
   ```bash
   git clone https://github.com/your-username/helloworldng.git
   ```
3. Navigate to the project directory:
   ```bash
   cd helloworldng
   ```
4. Install PHP dependencies:
   ```bash
   composer install
   ```
5. Install Node.js dependencies (if applicable):
   ```bash
   npm install
   ```
6. Create a new branch for your work:
   ```bash
   git checkout -b feature/your-feature-name
   ```

## Contribution Guidelines

### Code Contributions
We welcome code contributions but expect high-quality, intentional submissions aligned with the project's early-stage goals. Focus on modular, maintainable code that supports a flexible PHP and Node.js architecture.

1. **Follow the Project Structure**:
   - Adhere to organized directory structures (e.g., `src/`, `config/`, `assets/`).
   - Place Node.js-related code in appropriate folders (e.g., `assets/js/` or `scripts/`).
2. **Write Clear Code**:
   - Use meaningful names for classes, methods, and variables (e.g., follow PSR-12 for PHP).
   - Add PHPDoc blocks for complex logic or public APIs.
   - Write code that is framework-agnostic where possible, unless specific `/illuminate` packages are used.
3. **Test Your Code**:
   - Include unit or integration tests using PHPUnit (e.g., `tests/` directory).
   - Since the project is non-functional, mock dependencies or use in-memory databases (e.g., SQLite) for tests.
4. **Avoid "Vibe Coding"**:
   - Do not submit untested, speculative, or "hallucinated" code (e.g., AI-generated code without review).
   - Ensure your code aligns with the project's goals and avoids overly complex or framework-specific patterns unless necessary.

### Using AI-Assisted Coding
AI tools (e.g., GitHub Copilot, Grok) are welcome but must be used responsibly:
- **Review AI Output**: Treat AI-generated code as a draft. Verify it aligns with project goals and is clean, functional code.
- **No Blind Commits**: Do not commit AI-generated code without understanding, testing, and refining it.
- **Document AI Use**: In your pull request, note if AI tools were used (e.g., "Used Copilot for initial class setup, manually optimized and tested").
- **PHP/Node.js Tips**:
   - Ensure AI-generated code follows PSR-12 for PHP or ESLint for JavaScript.
   - If `/illuminate` packages are involved, validate proper usage (e.g., correct dependency injection).

### Submitting a Pull Request (PR)
1. Push your changes to your fork:
   ```bash
   git push origin feature/your-feature-name
   ```
2. Open a PR against the `main` branch of [jfinstrom/helloworldng](https://github.com/jfinstrom/helloworldng).
3. In your PR description:
   - Explain the purpose of your changes.
   - Reference related issues (e.g., `Fixes #123`).
   - Note if AI tools were used and how you validated the code.
4. Ensure your PR passes automated checks (e.g., PHPStan, ESLint, or GitHub Actions CI, if set up).

### Non-Code Contributions
We value contributions beyond code, including:
- Writing documentation (e.g., updating `README.md` or creating API docs).
- Reporting bugs or suggesting features via GitHub Issues.
- Improving this `CONTRIBUTING.md` or other guides.
- Suggesting improvements for PHP/Node.js integration or dependency management.

## Code of Conduct
Be respectful and professional in all interactions. We follow the [Contributor Covenant Code of Conduct](https://www.contributor-covenant.org/version/2/0/code_of_conduct/).

## Developer, Not Project Manager
Focus on development tasks rather than managing the project. For major changes or new features:
- Open a GitHub Issue to discuss with maintainers.
- Avoid proposing large-scale architectural changes unless coordinated with the core team.

## Getting Help
- Review the [README.md](https://github.com/jfinstrom/helloworldng/blob/main/README.md) for setup details.
- Ask questions via GitHub Issues.
- For AI-related questions, clarify how you validated AI outputs before seeking help.
- For `/illuminate` package usage, refer to their respective READMEs on GitHub.

## License
By contributing, you agree that your contributions will be licensed under the project's [LICENSE](https://github.com/jfinstrom/helloworldng/blob/main/license.txt).

Thank you for helping build HelloWorldNG!

