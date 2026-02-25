import os
import re

base_dir = r"c:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2"
output_file = os.path.join(base_dir, "audit_raw.md")

with open(output_file, 'w', encoding='utf-8') as out:
    out.write("# RAW DATA FOR AUDIT\n\n")

    # 1.1 Arborescence
    out.write("## 1.1 Arborescence (Models, Controllers, Migrations, Seeders, Views)\n")
    dirs_to_scan = [
        ("Models", "app/Models"),
        ("Controllers", "app/Http/Controllers"),
        ("Migrations", "database/migrations"),
        ("Seeders", "database/seeders"),
        ("Views", "resources/views"),
        ("Filament", "app/Filament"),
        ("Middleware", "app/Http/Middleware"),
    ]
    for label, path in dirs_to_scan:
        full_path = os.path.join(base_dir, path)
        if os.path.exists(full_path):
            files = []
            for r, d, f in os.walk(full_path):
                for file in f:
                    files.append(os.path.relpath(os.path.join(r, file), full_path))
            out.write(f"- {label}: {len(files)} fichiers\n")
            for f in sorted(files):
                out.write(f"  - {f}\n")

    # 3. Models Details
    out.write("\n## 3. Models Analysis\n")
    models_dir = os.path.join(base_dir, "app/Models")
    if os.path.exists(models_dir):
        for f in os.listdir(models_dir):
            if f.endswith('.php'):
                with open(os.path.join(models_dir, f), 'r', encoding='utf-8') as m:
                    content = m.read()
                    fillable = re.search(r'\$fillable\s*=\s*\[(.*?)\]', content, re.DOTALL)
                    guarded = re.search(r'\$guarded\s*=\s*\[(.*?)\]', content, re.DOTALL)
                    relations = re.findall(r'public function (\w+)\(\)\s*\{[^{}]*return \$this->(hasMany|belongsTo|belongsToMany|hasOne)', content)
                    out.write(f"### {f}\n")
                    if fillable: out.write("- fillable defined\n")
                    if guarded: out.write("- guarded defined\n")
                    for rel, rtype in relations:
                        out.write(f"- relation: {rel} ({rtype})\n")

    # 4. Controller Details (N+1)
    out.write("\n## 4. Controller N+1 Check\n")
    ctrl_dir = os.path.join(base_dir, "app/Http/Controllers")
    if os.path.exists(ctrl_dir):
        for r, d, f in os.walk(ctrl_dir):
            for file in f:
                if file.endswith('.php'):
                    with open(os.path.join(r, file), 'r', encoding='utf-8') as c:
                        lines = c.readlines()
                        for i, line in enumerate(lines):
                            if '::all()' in line or '->get()' in line:
                                if 'with(' not in line:
                                    out.write(f"- POTENTIAL N+1 in {file}:{i+1} : {line.strip()}\n")

    # 8. Security Middlewares
    out.write("\n## 8. Security\n")
    kernel_path = os.path.join(base_dir, "bootstrap/app.php")
    if os.path.exists(kernel_path):
        with open(kernel_path, 'r', encoding='utf-8') as k:
            out.write("### app.php (Middleware Registration)\n")
            out.write(k.read())
            
print("Audit raw data generated in audit_raw.md")
