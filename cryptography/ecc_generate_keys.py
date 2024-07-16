from ecdsa import SigningKey, NIST384p

sk = SigningKey.generate(curve=NIST384p)
vk = sk.verifying_key

with open("private.pem", "wb") as prv_file:
    prv_file.write(sk.to_pem())
with open("public.pem", "wb") as pub_file:
    pub_file.write(vk.to_pem())
