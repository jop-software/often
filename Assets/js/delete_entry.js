function deleteEntry(id) {
    Swal.fire({
        title: `Eintrag #${id} löschen`,
        text: "Sicher, das du den Eintrag löschen möchtest?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ja',
        cancelButtonText: 'Nein'
    }).then((result) => {
        if (result.value) {
            let form = document.querySelector("#delete_entry");
            form.submit();
        }
    })
}