document.addEventListener('DOMContentLoaded', function() {
    const notificationIcon = document.querySelector('.notifications-icon');
    const notificationsMenu = document.querySelector('.notifications-menu');
    
    if (notificationIcon && notificationsMenu) {
        notificationIcon.addEventListener('click', function() {
            notificationsMenu.classList.toggle('show');
        });
        
        // Fermer le menu si on clique en dehors
        document.addEventListener('click', function(event) {
            if (!notificationIcon.contains(event.target) && !notificationsMenu.contains(event.target)) {
                notificationsMenu.classList.remove('show');
            }
        });
    }
    
    // Marquer une notification comme lue
    const notificationItems = document.querySelectorAll('.notification-item');
    notificationItems.forEach(item => {
        item.addEventListener('click', function() {
            const notificationId = this.dataset.id;
            markNotificationAsRead(notificationId);
        });
    });
});

function markNotificationAsRead(notificationId) {
    fetch('mark_notification_read.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + notificationId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateNotificationCount();
        }
    });
}