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
                    <li> <i class="fas fa-tint"></i>  ${data.blood_group}
                    <li><i class="fas fa-calendar-check"></i>  ${data.role}
                `;
            
                 } else {
                alert("Failed to load user data.");
            }
        })
        .catch(error => console.error("AJAX error:", error));
});

 




