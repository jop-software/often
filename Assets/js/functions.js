function deleteEntry(id) {
    Swal.fire({
        title: `Eintrag #${id} löschen`,
        text: "Sicher, das du den Eintrag löschen möchtest?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Löschen',
        cancelButtonText: 'Abbrechen'
    }).then((result) => {
        if (result.value) {
            let form = document.querySelector("#delete_entry");
            form.submit();
        }
    })
}