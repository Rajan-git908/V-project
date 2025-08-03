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