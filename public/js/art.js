document.addEventListener('DOMContentLoaded', () => {
    if ("art" in localStorage) {
        console.log('art existe...')
        table()
    } else {
        console.log('art nuevo...')
        fetchData()
    }
})

const fetchData = async () => {
    try {
        const res = await fetch('./api/art.php')
        const data = await res.json()
        localStorage.setItem('art', JSON.stringify(data));
        const array = localStorage.getItem('art');
        arts = JSON.parse(array);
        table()
    } catch (error) {
        console.log(error)
    }
}

function table() {
    let array = localStorage.getItem('art');
    arts = JSON.parse(array);
    $('#example').dataTable({
        "data": arts,
        "columns": [{
            "data": "idart"
        }, {
            "data": "codigo"
        }, {
            "data": "articulo"
        }, {
            "data": "categoria"
        },{
            "data": "ubicacion"
        },{
            "data": "proveedor"
        },{
            "data": "m1"
        },{
            "data": "v1"
        },{
            "data": "m2"
        },{
            "data": "v2"
        },{
            "data": "m3"
        },{
            "data": "v3"
        }],
        //"pagingType": "simple",
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todas"]],
        "language": {
            "url": "./datatables/Spanish.json"
        }
    });
}