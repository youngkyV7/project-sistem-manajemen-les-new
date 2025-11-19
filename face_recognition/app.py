from flask import Flask, request, jsonify
import face_recognition
import base64
import cv2
import numpy as np
import os
from flask_cors import CORS

app = Flask(__name__)
CORS(app)  # agar Laravel bisa akses Flask

# 📁 Folder penyimpanan foto siswa
FACES_DIR = r"D:/Xampp/htdocs/project-sistem-manajemen-les-new/storage/app/public/siswa_images"

# --- Muat wajah siswa yang sudah ada ---
def load_known_faces():
    known_faces = []
    known_names = []

    for file in os.listdir(FACES_DIR):
        if file.endswith(('.jpg', '.jpeg', '.png')):
            path = os.path.join(FACES_DIR, file)
            image = face_recognition.load_image_file(path)
            encoding = face_recognition.face_encodings(image)
            if len(encoding) > 0:
                known_faces.append(encoding[0])
                known_names.append(os.path.splitext(file)[0])
            else:
                print(f"⚠️ Tidak ada wajah terdeteksi di {file}")

    print(f"✅ {len(known_faces)} wajah berhasil dimuat dari {FACES_DIR}")
    return known_faces, known_names

# Muat wajah saat Flask mulai
known_faces, known_names = load_known_faces()

# --- Route verifikasi wajah ---
@app.route('/verify', methods=['POST'])
def verify_face():
    try:
        print("📸 Request diterima dari Laravel")

        data = request.get_json()
        if not data or 'image' not in data:
            return jsonify({'status': 'error', 'message': 'Tidak ada gambar dikirim.'}), 400

        image_data = base64.b64decode(data['image'].split(',')[1])
        np_arr = np.frombuffer(image_data, np.uint8)
        frame = cv2.imdecode(np_arr, cv2.IMREAD_COLOR)

        rgb_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
        face_locations = face_recognition.face_locations(rgb_frame)
        face_encodings = face_recognition.face_encodings(rgb_frame, face_locations)

        if len(face_encodings) == 0:
            return jsonify({'status': 'failed', 'message': 'Wajah tidak terdeteksi.'}), 400

        face_encoding = face_encodings[0]
        matches = face_recognition.compare_faces(known_faces, face_encoding, tolerance=0.45)
        face_distances = face_recognition.face_distance(known_faces, face_encoding)

        if True in matches:
            best_match_index = np.argmin(face_distances)
            name = known_names[best_match_index]
            print(f"✅ Wajah dikenali sebagai: {name}")
            return jsonify({'status': 'success', 'name': name}), 200

        print("❌ Wajah tidak dikenali.")
        return jsonify({'status': 'failed', 'message': 'Wajah tidak dikenali.'}), 400

    except Exception as e:
        print(f"💥 Error di Flask: {e}")
        return jsonify({'status': 'error', 'message': str(e)}), 500


if __name__ == '__main__':
    app.run(host='127.0.0.1', port=5000, debug=True)
