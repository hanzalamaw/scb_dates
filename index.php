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
}

.logos{
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 90%;
  margin: 1.5rem 3.5rem;
}
.totalProgress{
  width: 87%;
  margin: 1rem 3.5rem;
  background-color: white !important;
  box-shadow: 0px 0px 8px 6px rgba(0, 0, 0, 0.034);
  border-radius: 15px;
  padding: 1rem 1.8rem;
}

.totalProgress p, .cityProgress h2, .cityProgress #cityBreakdown,.city-label span, .dataTable h2, .dataTable input, .dataTable select, .dataTable table tr td, .cityProgress h2{
  background-color: white !important;
}

.cityProgress{
  width: 87%;
  margin: 1rem 3.5rem;
  background-color: white !important;
  box-shadow: 0px 0px 8px 6px rgba(0, 0, 0, 0.034);
  border-radius: 15px;
  padding: 1rem 1.8rem;
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.statusProgress{
  width: 87%;
  margin: 1rem 3.5rem;
  background-color: white !important;
  box-shadow: 0px 0px 8px 6px rgba(0, 0, 0, 0.034);
  border-radius: 15px;
  padding: 1rem 1.8rem;
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

footer {
  width: 87%;
  margin: 0rem 3.5rem;
  border-radius: 15px;
  padding: 0rem 1.8rem;
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  text-align: center;
}

.dataTable{
  width: 87%;
  margin: 1rem 3.5rem;
  background-color: white !important;
  box-shadow: 0px 0px 8px 6px rgba(0, 0, 0, 0.034);
  border-radius: 15px;
  padding: 1rem 1.8rem;
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}


.city-row {
  background-color: white !important;
  width: 48%;
  margin-bottom: 17px;
}

.city-label {
  background-color: white !important;
  display: flex;
  justify-content: space-between;
  font-weight: 600;
  margin-bottom: 5px;
}

.progress-bar-bg {
  height: 8px;
  background-color: #f0f0f0;
  border-radius: 10px;
  overflow: hidden;
  margin-bottom: 0.8rem;
}

.progress-bar-fill {
  height: 8px;
  background-color: #007bff;
  border-radius: 10px 0 0 10px;
  width: 0;
  transition: width 1s ease-in-out;
}

table th, table td {
  font-size: 14px;
  width: 15rem;
  word-wrap: break-word;
  padding: 1rem;
}

.status-tag {
  padding: 5px 12px;
  border-radius: 8px;
  font-weight: 500;
  display: inline-block;
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
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  gap: 4.5rem;
  padding-bottom: 1rem;
}

.card{
  
  background-color: white !important;
  display: flex;
  justify-content: left;
  align-items: center;
  gap: 0.8rem;
}

.card img{
  background-color: white !important;
  width: 6rem;
  height: 6rem;
}

.card-content{
  background-color: white !important;
  display: flex;
  flex-direction: column;
  justify-content: left;
  text-align: left;
  align-items: flex-start;
  gap: 0.7REM;
}

.card-content span, .card-content h4{
  background-color: white !important;
  line-height: 1;
  padding: 0 !important;
  margin: 0 !important;
}

.card-content span{
  font-size: 0.9rem;
  font-weight: 500;
  color: rgba(0, 0, 0, 0.575);
}

.card-content h4{
  font-size: 1.5rem;
}



@media (max-width: 768px){
  .logos{
    width: 95%;
    margin: 1.5rem 7%;
  }

  .logos .twf{
    width: 11rem;
    height: auto;
  }

  .logos .scb{
    width: 9rem;
    height: auto;
  }

  .totalProgress{
    width: 87%;
    margin: 1rem 7%;
  }

  .cityProgress{
    width: 87%;
    margin: 1rem 7%;
  }

  .dataTable{
    width: 87%;
    margin: 1rem 7%;
  }

  .city-row {
    width: 100%;
    margin-bottom: 17px;
  }

  .statusProgress{
    width: 87%;
    margin: 1rem 7%;
  }

  .cards{
    gap: 1.5rem;
    padding: 0% 15%;
  }

  .card{
    flex: 1;
  }
}

</style>
<body>
    <div class="logos">
        <img class="twf" src="imgs/logo.png" alt="" height="75rem" width="auto">
        <img class="scb" src="imgs/images.png" alt="" height="75rem" width="auto">
    </div>
    <div class="totalProgress">
        <div style="margin-bottom: 1rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; background-color: white !important;">
              <p style="font-weight: bold; font-size: 1.1rem;">Mango Baskets Delivered</p>
              <p id="deliveryPercent" style="color: limegreen; font-weight: bold; font-size: 1.1rem;">Loading..</p>
            </div>
            <div style="width: 100%; background-color: #f6f6f6; border-radius: 8px; height: 24px; overflow: hidden;">
              <div id="progressBar" style="height: 100%; background-color: limegreen; width: 0%; transition: width 0.5s ease;"></div>
            </div>
        </div>
    </div>

    <div class="cityProgress">
      <h2 style="text-align: center;">CITY-WISE DELIVERY BREAKDOWN</h2>
      <div id="cityBreakdown" style="display: flex; flex-wrap: wrap; justify-content: space-between;"></div>
    </div>

    <div class="statusProgress">
      <h2 style="text-align: center; background-color: white !important;">STATUS-WISE BREAKDOWN</h2>

      <div class="cards">
        <div class="card">
          <img src="imgs/farm.png" alt="Farm">

          <div class="card-content"> 
            <span>At Our Farm</span>
            <h4 id="farm">Loading...</h4>
          </div>
        </div>

        <div class="card">
          <img src="imgs/warehouse.png" alt="warehouse">

          <div class="card-content"> 
            <span>At Our Warehouse</span>
            <h4 id="warehouse">Loading...</h4>
          </div>
        </div>

        <div class="card">
          <img src="imgs/packing.png" alt="packing">

          <div class="card-content"> 
            <span>Being Packed</span>
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

      <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; margin: 20px 0; background-color: white !important;">
        <h2 style="font-weight: bold;">All Deliveries</h2>

        <div class="filters" style="background-color: white !important; display: flex; gap: 0.5rem;">
          <input type="text" id="searchInput" placeholder="Search" style="padding: 10px; width: 200px; border-radius: 10px; border: 1px solid #ddd;">
          <select id="cityFilter" style="padding: 10px; border-radius: 10px; border: 1px solid #ddd;">
            <option value="">All Cities</option>
          </select>
        </div>
        
      </div>

      <div class="table-wrapper" style="max-height: 500px; overflow-y: auto; border-radius: 15px;">
        <table style="width: 100%; border-collapse: collapse; background-color: white;">
          <thead style="position: sticky; top: 0; background-color: white; z-index: 1; border-bottom: 1px solid #eee; background-color: #cecece !important;">
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
        <p>© 2025 The Warsi Farm. All rights reserved.</p>
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
  const farmCount = allData.filter(c => c.status === "At Our Farm").length;
  const warehouseCount = allData.filter(c => c.status === "At Our Warehouse").length;
  const packingCount = allData.filter(c => c.status === "Being Packed").length;
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
          <span style="font-size: 1.2rem;">${city}</span>
          <span style="color:#007bff;">(${delivered}/${total}) <span style="font-size: 1.2rem;">${percent}%</span></span>
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
        <span class="status-tag ${row.status === 'Delivered' ? 'status-delivered' : row.status === 'Being Packed' ? 'status-packing' : row.status === 'At Our Warehouse' ? 'status-warehouse' : 'status-pending'}">
          ${row.status === 'Delivered' ? 'Delivered' : row.status === 'Being Packed' ? 'Being Packed' : row.status === 'At Our Warehouse' ? 'At Our Warehouse' : 'At Our Farm'}
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

// Filter on search and city
function applyFilters() {
  const searchText = document.getElementById("searchInput").value.toLowerCase();
  const city = document.getElementById("cityFilter").value;
  const filtered = allData.filter(row =>
    (row.name.toLowerCase().includes(searchText) ||
     row.contact.toLowerCase().includes(searchText) ||
     row.address.toLowerCase().includes(searchText)) &&
    (city === "" || row.city === city)
  );
  renderTable(filtered);
}

// Initial render

// Event listeners
document.getElementById("searchInput").addEventListener("input", applyFilters);
document.getElementById("cityFilter").addEventListener("change", applyFilters);

</script>
</html>