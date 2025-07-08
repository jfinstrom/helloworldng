# FreePBX Module the next generation:

Imagine living in 2025 with a more modern php and still writing PHP for 2013. I know right.  
While we are still constricted to certain FreePBX limits that doesn't mean we can't otherwise make magic, use good habbits
perhaps modern tools/libraries etc. Will they adopt this upstream? Probably not. But as a PoC 3rd party developers can use this as a base concept and make modules that aren't a essentially a pretty monolith that is hard to maintain and overall not very good. Mind you upstream they are still using design choices they didn't have a say in. I was part of some of these poor choices. Some were made because of technilogical limitations and others from business decisions. In something like this I have a minimum of PHP 8.2 and some expierience under my belt in newer PHP technologies I simply didn't get to use in the past. Note this is a personal project and not an official FreePBX project. I am not a FreePBX staff developer, but I am one of the few folks that know FreePBX down to its core so I may be the best for this adventure.

1. FreePBX is a trademark of Sangoma Technologies Inc. Other trademarks are the property of their respective owners.
2. This project is not affiliated with Sangoma Technologies Inc. or FreePBX.
3. This project is not an official FreePBX project and does not represent the views or opinions of Sangoma Technologies Inc.
4. This project is not a product of my employer and does not represent the views or opinions of my employer.
5. This project is not intended to replace or compete with FreePBX, but rather to provide a proof of concept for a more modern approach to FreePBX module development.
6. This project is not intended to be used in production environments and is for educational purposes only.
7. This is provided as-is with no warranty or guarantee of any kind. Use at your own risk. There are definitely bugs and issues.

---

## WARNING: Use of this software may cause unexpected side effects, including but not limited to: spontaneous urge to rewrite code in assembly language, uncontrollable muttering of "it works on my machine," sudden cravings for energy drinks at 3 AM, temporary loss of ability to distinguish tabs from spaces, vivid hallucinations of perfectly aligned CSS, compulsive refactoring of legacy code, inexplicable desire to argue about vi vs. emacs, spontaneous outbursts of "I forgot to push to git," mild to severe keyboard rage, and/or an irrational fear of merge conflicts. In rare cases, users may experience a 72-hour debugging session with no resolution, spontaneous growth of a neckbeard, or the compulsion to name all variables after sci-fi characters. Consult your sysadmin if you experience stack overflow panic attacks, recursive function nightmares, or if your terminal remains unresponsive for more than 4 hours. Do not use this software if you are allergic to semicolons or have a history of regex-induced migraines. By using this software, you acknowledge that no one, not even the developer, knows exactly how it works. Proceed at your own risk.

# Who is your daddy and what does he do?

At the moment this is scaffolding and a braindump of a madman. I have not figured out pracitical demonstrations for this yet. Mostly I am setting up the base at the moment. I may actually branch when the base is in place to allow anyone who wants to use this have something they don't have to rip my crap out of.

# Non-Exhaustive Fork & Rename Checklist: Helloworldng → FlyingMonkey

- [ ] **Namespaces:**
    - Change all `FreePBX\modules\Helloworldng` to `FreePBX\modules\FlyingMonkey`  
      (including sub-namespaces in `/src/` and `/Console/`)

- [ ] **Class Names:**
    - Rename all classes named `Helloworldng` to `FlyingMonkey`  
      (e.g., `/Helloworldng.class.php`, `/Console/Helloworldng.class.php`)

- [ ] **File Names:**
    - Rename files and folders:
        - `Helloworldng.class.php` → `FlyingMonkey.class.php`
        - `/Console/Helloworldng.class.php` → `/Console/FlyingMonkey.class.php`
        - Any other files/folders named `helloworldng` or `helloworld`

- [ ] **Composer Autoload:**
    - In `composer.json`:
        - Change `"FreePBX\\Modules\\Helloworldng\\": "src/"`  
          to `"FreePBX\\Modules\\FlyingMonkey\\": "src/"`
        - Change `"name": "jfinstrom/helloworldng"`  
          to your own vendor/package name

- [ ] **Module XML:**
    - In `module.xml`:
        - Change `<rawname>helloworldng</rawname>` to `<rawname>flyingmonkey</rawname>`
        - Change `<class>Helloworldng</class>` to `<class>FlyingMonkey</class>`

- [ ] **References in Code:**
    - Update all code references:
        - `Helloworldng` → `FlyingMonkey`
        - `helloworldng` → `flyingmonkey`
        - `helloworld` → `flyingmonkey`
        - (case-sensitive, including variable names, comments, and strings)

- [ ] **Database Table Prefixes:**
    - In `/src/Utility/DatabaseUtility.php` and any migrations:
        - Change `'prefix' => 'helloworldng_'` to `'prefix' => 'flyingmonkey_'`
        - Update any table names or migration references

- [ ] **README and Documentation:**
    - Update all mentions of "Helloworldng", "helloworldng", or "helloworld" to "FlyingMonkey"  
      (including badges, instructions, and examples)

- [ ] **Other Config Files:**
    - Check for any other config or script files referencing "helloworldng" or "helloworld"

---

**Tip:**  
Use a case-sensitive search-and-replace tool to ensure all instances are updated.

# License

Dual licensed see [LICENSE] file for details.
