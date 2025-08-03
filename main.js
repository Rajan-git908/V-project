document.addEventListener("DOMContentLoaded", function () {
    const userId = document.body.dataset.userId;
    fetch("fatch_user_data.php")
        .then(response => response.json())
        .then(data => {
            if (!data.error) {
                document.getElementById("name").textContent = data.Name;
                document.querySelector(".profile-body ul").innerHTML = `
                    <li>ID: ${userId}</li>
                    <li>Blood Group: ${data.blood_group_id}</li>
                    <li>Status: ${data.is_active}</li>
                `;
                document.getElementById("count").textContent = data.total_donations;
                document.getElementById("count1").textContent = data.lives_impacted;
                document.getElementById("count2").textContent = parseInt(data.total_donations) + 5;
            } else {
                alert("Failed to load user data.");
            }
        })
        .catch(error => console.error("AJAX error:", error));
});


//graph
fetch("fetch_donation_data.php").then(response=>response.json()).then(monthlyData=>{
const labels= ['Jan', 'Feb', 'Mar', 'Apr', 'May','june','july','Aug','Sep','Oct','Nov','Dec'];

const ctx = document.getElementById('donationChart').getContext('2d');
const donationChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels:labels,
        datasets: [{
            label: 'Donations',
            data: monthlyData,
            backgroundColor: 'rgba(255, 99, 132, 0.5)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});
})
.catch(error=>console.error("chart data error:", error));