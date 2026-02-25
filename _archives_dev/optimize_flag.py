from PIL import Image
import os

source_path = r"c:\Users\ulric\Downloads\servicepublic-bf-v2\servicepublic-bf-v2\public\img\drapeau.png"

try:
    img = Image.open(source_path)
    # Resize to a reasonable icon size (e.g., 64px height) while maintaining aspect ratio
    # The original is likely huge, and for web icon usage 64px height is plenty.
    base_height = 64
    w_percent = (base_height / float(img.size[1]))
    w_size = int((float(img.size[0]) * float(w_percent)))
    
    img = img.resize((w_size, base_height), Image.Resampling.LANCZOS)
    
    # Save directly over source with optimization
    img.save(source_path, "PNG", optimize=True)
    print(f"Image optimized: {w_size}x{base_height}")

except Exception as e:
    print(f"Error: {e}")
