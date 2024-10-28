function eliminarMiembro(projectId, memberId) {
    fetch('eliminarMiembro.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `project_id=${projectId}&member_id=${memberId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.success);
            // Actualiza la interfaz después de eliminar
        } else {
            alert(data.error);
        }
    })
    .catch(error => console.error('Error:', error));
}
