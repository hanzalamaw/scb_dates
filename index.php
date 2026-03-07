<?php require_once __DIR__ . '/auth/verify.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TWF x SCB</title>
</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

*{
  background-color: #FAFBFF;
  font-family: 'Poppins', sans-serif;
  box-sizing: border-box;
}

html {
  font-size: 14px;
}

.logos{
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 90%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 1.25rem 1.5rem 1.25rem;
}
.logos .twf, .logos .scb {
  height: 3rem;
  width: auto;
  object-fit: contain;
}
.totalProgress{
  width: 90%;
  max-width: 1200px;
  margin: 0.5rem auto 0.5rem;
  background-color: white !important;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
  border-radius: 10px;
  padding: 0.75rem 1.25rem;
}

.totalProgress p, .cityProgress h2, .cityProgress #cityBreakdown, .city-label span, .dataTable h2, .dataTable input, .dataTable select, .dataTable table tr td, .dataTable table th, .cityProgress h2 {
  background-color: white !important;
}

table tbody tr:hover td {
  background-color: #fafafa !important;
}

.cityProgress{
  width: 90%;
  max-width: 1200px;
  margin: 0.5rem auto 0.5rem;
  background-color: white !important;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
  border-radius: 10px;
  padding: 0.75rem 1.25rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.cityProgress h2 {
  font-size: 0.95rem;
  font-weight: 600;
  letter-spacing: 0.02em;
  margin: 0 0 0.25rem 0;
}

.statusProgress{
  width: 90%;
  max-width: 1200px;
  margin: 0.5rem auto 0.5rem;
  background-color: white !important;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
  border-radius: 10px;
  padding: 0.75rem 1.25rem;
  display: flex;
  flex-direction: column;
  gap: 0;
  align-items: center;
}

.statusProgress h2 {
  font-size: 0.95rem;
  font-weight: 600;
  letter-spacing: 0.02em;
  margin: 0 0 1.25rem 0;
}

.logout-btn {
  display: flex;
  align-items: center;
  gap: 5px;
  font-size: 0.78rem;
  font-weight: 500;
  color: #888;
  text-decoration: none;
  padding: 0.35rem 0.75rem;
  border: 1px solid #ddd;
  border-radius: 6px;
  transition: color 0.2s, border-color 0.2s, background-color 0.2s;
}
.logout-btn:hover {
  color: #DF0404;
  border-color: #DF0404;
  background-color: rgba(223,4,4,0.05) !important;
}
.logout-btn svg { flex-shrink: 0; }

footer {
  width: 90%;
  max-width: 1200px;
  margin: 0.5rem auto 1rem;
  padding: 0.5rem 1rem;
  text-align: center;
  font-size: 0.8rem;
  color: #666;
}

.dataTable{
  width: 90%;
  max-width: 1200px;
  margin: 0.5rem auto 0.5rem;
  background-color: white !important;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
  border-radius: 10px;
  padding: 0.75rem 1.25rem;
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.dataTable h2 {
  font-size: 0.95rem;
  font-weight: 600;
  margin: 0;
}


.city-row {
  background-color: white !important;
  width: 48%;
  margin-bottom: 0.6rem;
}

.city-label {
  background-color: white !important;
  display: flex;
  justify-content: space-between;
  font-weight: 600;
  font-size: 0.85rem;
  margin-bottom: 0.25rem;
}

.progress-bar-bg {
  height: 6px;
  background-color: #f0f0f0;
  border-radius: 6px;
  overflow: hidden;
  margin-bottom: 0.5rem;
}

.progress-bar-fill {
  height: 6px;
  background-color: #007bff;
  border-radius: 6px 0 0 6px;
  width: 0;
  transition: width 1s ease-in-out;
}

table th, table td {
  font-size: 0.8rem;
  word-wrap: break-word;
  padding: 0.5rem 0.65rem;
  max-width: 12rem;
}

table th {
  font-weight: 600;
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 0.03em;
  color: #555;
}

table tbody tr {
  border-bottom: 1px solid #f0f0f0;
}

table tbody tr:hover {
  background-color: #fafafa;
}

.status-tag {
  padding: 0.25rem 0.5rem;
  border-radius: 6px;
  font-weight: 500;
  font-size: 0.75rem;
  display: inline-block;
  white-space: nowrap;
}

.status-delivered {
  background-color: rgba(162, 226, 195, 0.30);
  color: #00AC4F;
  border: 1px solid #00AC4F;
}

.status-packing {
  background-color: #07a7c321;
  color: #07A7C3;
  border: 1px solid #07A7C3;
}

.status-warehouse {
  background-color: #f3b2272c;
  color: #F3B227;
  border: 1px solid #F3B227;
}

.status-pending {
  background-color: #df04041e;
  color: #DF0404;
  border: 1px solid #DF0404;
}

.cards{
  background-color: white !important;
  display: flex;
  justify-content: space-between;
  align-items: stretch;
  flex-wrap: wrap;
  gap: 1rem;
  width: 85%;
  max-width: 85%;
  margin: 0 auto;
  padding-bottom: 0.25rem;
}

.card{
  background-color: white !important;
  display: flex;
  justify-content: flex-start;
  align-items: center;
  gap: 0.75rem;
  flex: 1;
  min-width: 0;
}

.card img{
  background-color: white !important;
  width: 3.25rem;
  height: 3.25rem;
  object-fit: contain;
  flex-shrink: 0;
}

.card-content{
  background-color: white !important;
  display: flex;
  flex-direction: column;
  justify-content: center;
  text-align: left;
  align-items: flex-start;
  gap: 0.25rem;
}

.card-content span, .card-content h4{
  background-color: white !important;
  line-height: 1.2;
  padding: 0 !important;
  margin: 0 !important;
}

.card-content span{
  font-size: 0.85rem;
  font-weight: 500;
  color: rgba(0, 0, 0, 0.55);
}

.card-content h4{
  font-size: 1.2rem;
  font-weight: 600;
}



@media (max-width: 768px){
  .logos{
    width: 95%;
    margin: 0 auto;
    padding: 1rem;
  }

  .logos .twf, .logos .scb{
    height: 2.5rem;
    width: auto;
  }

  .totalProgress, .cityProgress, .dataTable, .statusProgress{
    width: 95%;
    margin-left: auto;
    margin-right: auto;
  }

  .city-row {
    width: 100%;
    margin-bottom: 0.6rem;
  }

  .cards{
    gap: 1rem;
    justify-content: center;
  }

  .card{
    flex: 1 1 45%;
    min-width: 140px;
  }

  .card img{
    width: 2.75rem;
    height: 2.75rem;
  }
}

</style>
<body>
    <div class="logos">
        <img class="twf" src="imgs/logo.png" alt="TWF">
        <a href="auth/logout.php" class="logout-btn" onclick="return confirm('Are you sure you want to sign out?')">
      <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="background:transparent !important;">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
      </svg>
      Sign out
    </a>
    </div>
    <div class="totalProgress">
        <div style="margin-bottom: 0.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; background-color: white !important;">
              <p style="font-weight: 600; font-size: 0.9rem; margin: 0;">Date Boxes delivered</p>
              <p id="deliveryPercent" style="color: #00AC4F; font-weight: 600; font-size: 0.9rem; margin: 0;">Loading..</p>
            </div>
            <div style="width: 100%; background-color: #f0f0f0; border-radius: 6px; height: 14px; overflow: hidden;">
              <div id="progressBar" style="height: 100%; background-color: #00AC4F; width: 0%; transition: width 0.5s ease;"></div>
            </div>
        </div>
    </div>

    <div class="cityProgress">
      <h2 style="text-align: center;">City-wise delivery breakdown</h2>
      <div id="cityBreakdown" style="display: flex; flex-wrap: wrap; justify-content: space-between;"></div>
    </div>

    <div class="statusProgress">
      <h2 style="text-align: center; background-color: white !important;">Status-wise breakdown</h2>

      <div class="cards">
        <div class="card">
          <img src="imgs/farm.png" alt="Farm">

          <div class="card-content"> 
            <span>In Production</span>
            <h4 id="farm">Loading...</h4>
          </div>
        </div>

        <div class="card">
          <img src="imgs/warehouse.png" alt="warehouse">

          <div class="card-content"> 
            <span>Quality Check</span>
            <h4 id="warehouse">Loading...</h4>
          </div>
        </div>

        <div class="card">
          <img src="imgs/packing.png" alt="packing">

          <div class="card-content"> 
            <span>Packed</span>
            <h4 id="packing">Loading...</h4>
          </div>
        </div>

        <div class="card">
          <img src="imgs/delivered.png" alt="delivered">

          <div class="card-content"> 
            <span>Delivered</span>
            <h4 id="delivered">Loading...</h4>
          </div>
        </div>
      </div>
    </div>

    <div class="dataTable">

      <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; margin: 0 0 0.5rem 0; gap: 0.5rem; background-color: white !important;">
        <h2 style="font-weight: 600;">All deliveries</h2>
        <div class="filters" style="background-color: white !important; display: flex; gap: 0.4rem; align-items: center;">
          <input type="text" id="searchInput" placeholder="Search" style="padding: 0.4rem 0.6rem; width: 160px; border-radius: 6px; border: 1px solid #ddd; font-size: 0.8rem;">
          <select id="cityFilter" style="padding: 0.4rem 0.6rem; border-radius: 6px; border: 1px solid #ddd; font-size: 0.8rem;">
            <option value="">All cities</option>
          </select>
          <select id="statusFilter" style="padding: 0.4rem 0.6rem; border-radius: 6px; border: 1px solid #ddd; font-size: 0.8rem;">
            <option value="">All</option>
            <option value="In Production">In Production</option>
            <option value="Quality Check">Quality Check</option>
            <option value="Packed">Packed</option>
            <option value="Delivered">Delivered</option>
          </select>
        </div>
      </div>

      <div class="table-wrapper" style="max-height: 380px; overflow-y: auto; border-radius: 8px; border: 1px solid #eee;">
        <table style="width: 100%; border-collapse: collapse; background-color: white;">
          <thead style="position: sticky; top: 0; z-index: 1; border-bottom: 1px solid #e0e0e0; background-color: #f5f5f5 !important;">
            <tr style="text-align: left;">
              <th>Name</th>
              <th>Company</th>
              <th>Address</th>
              <th>City</th>
              <th>Status</th>
            </tr>
          </thead>

          <tbody id="deliveryTableBody">
            <!-- Your rows will be injected here -->
          </tbody>
        </table>
      </div>


    </div>


    <footer>
        <p style="margin: 0;">© 2026 The Warsi Farm. All rights reserved.</p>
    </footer>
</body>
<script>
let allData = [];
function fetchData(){
  fetch('read_customer.php')
  .then(response => {
      if (!response.ok) {
      throw new Error("Network response was not ok");
      }
      return response.json();
  })
  .then(data => {
      allData = data;
      updateDeliveryProgress();
      updateCityProgress();
      updateStatusProgress();
      renderTable(allData);
      populateCityFilter();
  })
  .catch(error => {
      console.error("Error fetching data:", error);
  });
}

function updateDeliveryProgress() {
  const total = allData.length;
  const deliveredCount = allData.filter(c => c.status === "Delivered").length;

  const percentage = total === 0 ? 0 : Math.round((deliveredCount / total) * 100);

  // Update UI
  document.getElementById("deliveryPercent").innerText = percentage + "%";
  document.getElementById("progressBar").style.width = percentage + "%";
}

function updateStatusProgress() {
  const farmCount = allData.filter(c => c.status === "In Production").length;
  const warehouseCount = allData.filter(c => c.status === "Quality Check").length;
  const packingCount = allData.filter(c => c.status === "Packed").length;
  const deliveredCount = allData.filter(c => c.status === "Delivered").length;

  // Update UI
  document.getElementById("farm").innerText = farmCount;
  document.getElementById("warehouse").innerText = warehouseCount;
  document.getElementById("packing").innerText = packingCount;
  document.getElementById("delivered").innerText = deliveredCount;
}

fetchData();


function updateCityProgress(){
  const cityGroups = {};
  allData.forEach(entry => {
    const city = entry.city;
    if (!cityGroups[city]) cityGroups[city] = { total: 0, delivered: 0 };
    cityGroups[city].total++;
    if (entry.status === "Delivered") cityGroups[city].delivered++;
  });

  // Render city rows
  const container = document.getElementById("cityBreakdown");

  Object.entries(cityGroups).forEach(([city, { total, delivered }], index) => {
    const percent = Math.round((delivered / total) * 100);

    const id = `bar-${index}`; // Unique ID for animation target

    const cityHTML = `
      <div class="city-row">
        <div class="city-label">
          <span>${city}</span>
          <span style="color:#007bff; font-size: 0.85rem;">(${delivered}/${total}) ${percent}%</span>
        </div>
        <div class="progress-bar-bg">
          <div class="progress-bar-fill" id="${id}"></div>
        </div>
      </div>
    `;
    container.insertAdjacentHTML("beforeend", cityHTML);

    // Animate bar after DOM is painted
    setTimeout(() => {
      document.getElementById(id).style.width = percent + '%';
    }, 100); // slight delay to trigger animation
  });
}

function renderTable(data) {
  const tbody = document.getElementById("deliveryTableBody");
  tbody.innerHTML = "";
  data.forEach(row => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${row.name}</td>
      <td>${row.designation} - ${row.company}</td>
      <td>${row.address}</td>
      <td>${row.city}</td>
      <td>
        <span class="status-tag ${row.status === 'Delivered' ? 'status-delivered' : row.status === 'Packed' ? 'status-packing' : row.status === 'Quality Check' ? 'status-warehouse' : 'status-pending'}">
          ${row.status === 'Delivered' ? 'Delivered' : row.status === 'Packed' ? 'Packed' : row.status === 'Quality Check' ? 'Quality Check' : row.status === 'In Production' ? 'In Production' : row.status}
        </span>
      </td>
    `;
    tbody.appendChild(tr);
  });
}

// Populate filter dropdown
function populateCityFilter() {
  const cityFilter = document.getElementById("cityFilter");
  const cities = [...new Set(allData.map(row => row.city))];
  cities.forEach(city => {
    const option = document.createElement("option");
    option.value = city;
    option.textContent = city;
    cityFilter.appendChild(option);
  });
}

// Filter on search, city, and status
function applyFilters() {
  const searchText = document.getElementById("searchInput").value.toLowerCase();
  const city = document.getElementById("cityFilter").value;
  const status = document.getElementById("statusFilter").value;
  const filtered = allData.filter(row =>
    (row.name.toLowerCase().includes(searchText) ||
     (row.contact && row.contact.toLowerCase().includes(searchText)) ||
     row.address.toLowerCase().includes(searchText)) &&
    (city === "" || row.city === city) &&
    (status === "" || row.status === status)
  );
  renderTable(filtered);
}

// Event listeners
document.getElementById("searchInput").addEventListener("input", applyFilters);
document.getElementById("cityFilter").addEventListener("change", applyFilters);
document.getElementById("statusFilter").addEventListener("change", applyFilters);

</script>
</html>