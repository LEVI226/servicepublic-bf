import os

project_dir = r"c:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2"

def get_sizes(folder_path):
    files_info = []
    if os.path.exists(folder_path):
        for root, dirs, files in os.walk(folder_path):
            for file in files:
                path = os.path.join(root, file)
                size = os.path.getsize(path)
                files_info.append(f"{os.path.relpath(path, folder_path)}: {size / 1024:.2f} KB")
    return files_info

print("=== CSS FILES ===")
print("\n".join(get_sizes(os.path.join(project_dir, "public", "css"))))

print("=== JS FILES ===")
print("\n".join(get_sizes(os.path.join(project_dir, "public", "js"))))

print("=== ROUTES FILES ===")
print("\n".join(get_sizes(os.path.join(project_dir, "routes"))))

print("=== SEEDERS ===")
print("\n".join(get_sizes(os.path.join(project_dir, "database", "seeders"))))
