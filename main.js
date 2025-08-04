document.addEventListener("DOMContentLoaded", function () {
    const userId = document.body.dataset.userId;
    fetch("fatch_user_data.php")
        .then(response => response.json())
        .then(data => {
            if (!data.error) {
                document.getElementById("name").textContent = data.Name;
                document.querySelector(".profile-body ul").innerHTML = `
                    <li>ID: ${userId}</li>
                    <li><i class="fas fa-envelope"></i>  ${data.Email}
                    <li><i class="fas fa-phone"></i>  ${data.Phone}
                    <li> <i class="fas fa-map-marker-alt"></i>  ${data.Address}
                    <li> <i class="fas fa-tint"></i>  ${data.blood_group_id}
                    <li><i class="fas fa-calendar-check"></i>  ${data.role}
                    <li> Last donation: ${data.date}</li>
                <li> Next eligible: 2023-12-15</li>
                `;
                document.getElementById("totaldonations").textContent = data.total_donations;
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
            data: monthlyData, //[1,0,2,0,4,0,5,0,3,1]
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

function loadDonationHistory() {
        const container = document.getElementById('donationHistory');
        donationData.forEach(donation => {
            const card = document.createElement('div');
            card.className = 'donation-card';
            card.innerHTML = `
                <h3>${donation.date}</h3>
                <p><strong>Volume:</strong> ${donation.volume} ml</p>
                <p><strong>Location:</strong> ${donation.location}</p>
                ${donation.remarks ? `<p><strong>Remarks:</strong> ${donation.remarks}</p>` : ''}
            `;
            container.appendChild(card);
        });
    }

 

      function loadBloodRequests() {
        const container = document.getElementById('requestsList');
        bloodRequests.forEach(request => {
            const card = document.createElement('div');
            card.className = 'request-card';
            card.innerHTML = `
                <h3>${request.bloodType} Needed</h3>
                <p><strong>Hospital:</strong> ${request.hospital}</p>
                <p><strong>Required by:</strong> ${request.date}</p>
                <span class="tag ${request.urgency}">${request.urgency === 'urgent' ? 'URGENT' : 'Standard'}</span>
                <button style="float:right">Respond</button>
            `;
            container.appendChild(card);
        });
    }

    // Modal functions
    function openEditModal() {
        document.getElementById('editProfileModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('editProfileModal').style.display = 'none';
    }

    // Form submission handler
    document.getElementById('editProfileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Profile updated successfully!');
        closeModal();
    });

    // Load data on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadDonationHistory();
        loadBloodRequests();
        
        // Smooth scrolling for navigation
        document.querySelectorAll('nav a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    });