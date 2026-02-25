import urllib.request
import os

base_dir = r"c:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\public"
fa_css_dir = os.path.join(base_dir, "css", "fontawesome")
fa_fonts_dir = os.path.join(base_dir, "webfonts")

os.makedirs(fa_css_dir, exist_ok=True)
os.makedirs(fa_fonts_dir, exist_ok=True)

version = "6.5.1"
base_url = f"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/{version}"

print("Downloading Font Awesome CSS...")
css_url = f"{base_url}/css/all.min.css"
css_path = os.path.join(fa_css_dir, "all.min.css")
urllib.request.urlretrieve(css_url, css_path)

print("Downloading Font Awesome Webfonts...")
fonts = [
    "fa-solid-900.woff2",
    "fa-solid-900.ttf",
    "fa-brands-400.woff2",
    "fa-brands-400.ttf",
    "fa-regular-400.woff2",
    "fa-regular-400.ttf",
    "fa-v4compat.woff2",
    "fa-v4compat.ttf"
]

for font in fonts:
    font_url = f"{base_url}/webfonts/{font}"
    font_path = os.path.join(fa_fonts_dir, font)
    try:
        urllib.request.urlretrieve(font_url, font_path)
        print(f"Downloaded {font}")
    except Exception as e:
        print(f"Failed to download {font}: {e}")

# The all.min.css from cdnjs looks for fonts in ../webfonts/
print("All Font Awesome assets downloaded successfully!")
