<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Aplikasi Absen Sederhana</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      max-width: 600px;
      margin: 40px auto;
      padding: 20px;
    }
    input, button {
      padding: 10px;
      font-size: 16px;
    }
    button {
      cursor: pointer;
    }
    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
    }
  </style>
</head>
<body>

  <h2>📋 Aplikasi Absen Sederhana</h2>

  <input type="text" id="nama" placeholder="Masukkan nama..." />
  <button onclick="absen()">Absen</button>
  <button onclick="resetData()">Reset</button>

  <table>
    <thead>
      <tr>
        <th>Nama</th>
        <th>Waktu Absen</th>
      </tr>
    </thead>
    <tbody id="listAbsen"></tbody>
  </table>

  <script>
    let data = JSON.parse(localStorage.getItem("absenData")) || [];

    function render() {
      const tbody = document.getElementById("listAbsen");
      tbody.innerHTML = "";

      data.forEach(item => {
        tbody.innerHTML += `
          <tr>
            <td>${item.nama}</td>
            <td>${item.waktu}</td>
          </tr>
        `;
      });
    }

    function absen() {
      const nama = document.getElementById("nama").value.trim();
      if (!nama) return alert("Nama tidak boleh kosong!");

      const waktu = new Date().toLocaleString();

      data.push({ nama, waktu });
      localStorage.setItem("absenData", JSON.stringify(data));

      document.getElementById("nama").value = "";
      render();
    }

    function resetData() {
      if (confirm("Yakin mau hapus semua data?")) {
        localStorage.removeItem("absenData");
        data = [];
        render();
      }
    }

    render();
  </script>

</body>
</html>