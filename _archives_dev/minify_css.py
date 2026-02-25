import os
import re

css_path = r"c:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\public\css\style.css"
min_css_path = r"c:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\public\css\style.min.css"

with open(css_path, 'r', encoding='utf-8') as f:
    css = f.read()

# Remove comments
css = re.sub(r'/\*.*?\*/', '', css, flags=re.DOTALL)
# Remove newlines and tabs
css = css.replace('\n', '').replace('\r', '').replace('\t', '')
# Remove spaces around boundaries
css = re.sub(r'\s*{\s*', '{', css)
css = re.sub(r'\s*}\s*', '}', css)
css = re.sub(r'\s*:\s*', ':', css)
css = re.sub(r'\s*;\s*', ';', css)
css = re.sub(r'\s*,\s*', ',', css)

with open(min_css_path, 'w', encoding='utf-8') as f:
    f.write(css)

print("CSS Minified Successfully!")
