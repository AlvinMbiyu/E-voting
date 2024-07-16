from Crypto.Cipher import AES
import base64
import sys

key = base64.b64decode(sys.argv[1])
nonce = base64.b64decode(sys.argv[2])
ciphertext = base64.b64decode(sys.argv[3])

cipher = AES.new(key, AES.MODE_EAX, nonce=nonce)
plaintext = cipher.decrypt(ciphertext)

print(plaintext.decode())
