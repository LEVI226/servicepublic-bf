import sys

msg = sys.stdin.read()
lines = msg.split('\n')
clean_lines = [line for line in lines if not line.startswith('Co-Authored-By: Claude')]
sys.stdout.write('\n'.join(clean_lines))
