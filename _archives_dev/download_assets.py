import urllib.request
import re
import os

base_dir = r"c:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\public"
fonts_dir = os.path.join(base_dir, "fonts")
css_dir = os.path.join(base_dir, "css")
js_dir = os.path.join(base_dir, "js")

os.makedirs(fonts_dir, exist_ok=True)
os.makedirs(css_dir, exist_ok=True)
os.makedirs(js_dir, exist_ok=True)

# 1. Download Google Fonts WOFF2
print("Downloading Google Fonts...")
css_url = "https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap"
req = urllib.request.Request(css_url, headers={'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'})
try:
    with urllib.request.urlopen(req) as response:
        css_content = response.read().decode('utf-8')

    urls = re.findall(r'url\((https://[^)]+)\)', css_content)
    unique_urls = set(urls)

    for i, url in enumerate(unique_urls):
        filename = url.split('/')[-1]
        filepath = os.path.join(fonts_dir, filename)
        if not os.path.exists(filepath):
            print(f"Downloading {filename}...")
            urllib.request.urlretrieve(url, filepath)
        css_content = css_content.replace(url, f"../fonts/{filename}")

    with open(os.path.join(css_dir, "fonts.css"), "w", encoding="utf-8") as f:
        f.write(css_content)
    print("Fonts CSS saved.")
except Exception as e:
    print(f"Failed to process fonts: {e}")

# 2. Download Bootstrap
print("Downloading Bootstrap CSS/JS...")
bs_css_url = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
bs_js_url = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"

try:
    urllib.request.urlretrieve(bs_css_url, os.path.join(css_dir, "bootstrap.min.css"))
    urllib.request.urlretrieve(bs_js_url, os.path.join(js_dir, "bootstrap.bundle.min.js"))
    print("Bootstrap downloaded.")
except Exception as e:
    print(f"Failed to download Bootstrap: {e}")

print("All downloads complete.")
