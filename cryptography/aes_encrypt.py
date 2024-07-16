from Crypto.Cipher import AES
from Crypto.Random import get_random_bytes
import base64
import sys

key = get_random_bytes(16)
cipher = AES.new(key, AES.MODE_EAX)
nonce = cipher.nonce
data = sys.argv[1].encode()
ciphertext, tag = cipher.encrypt_and_digest(data)

print(base64.b64encode(key).decode(), base64.b64encode(nonce).decode(), base64.b64encode(ciphertext).decode())
