// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "tipo": "(Pelicula|Serie)",
    "region": "(ARG|ESP|KOR|MEX|USA)",
    "genero": "NA",
    "duracion": "00",
    "cuenta_id": 0  // Añadir el campo cuenta_id necesario
};


$(document).ready(function(){
    let edit = false;

    let JsonString = JSON.stringify(baseJSON, null, 2);
    $('#description').val(JsonString);
    $('#media-result').hide();
    listarMedios();

    function listarMedios() {
        $.ajax({
            url: './backend/media-list.php',
            type: 'GET',
            success: function(response) {
                const medios = JSON.parse(response);

                if (Object.keys(medios).length > 0) {
                    let template = '';

                    medios.forEach(medio => {
                        let descripcion = '';
                        descripcion += '<li>tipo: ' + medio.tipo + '</li>';
                        descripcion += '<li>region: ' + medio.region + '</li>';
                        descripcion += '<li>genero: ' + medio.genero + '</li>';
                        descripcion += '<li>duracion: ' + medio.duracion + '</li>';

                        template += `
                            <tr mediaId="${medio.id}">
                                <td>${medio.id}</td>
                                <td><a href="#" class="media-item">${medio.titulo}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="media-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });

                    $('#media').html(template);
                }
            }
        });
    }

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/media-search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        const medios = JSON.parse(response);

                        if (Object.keys(medios).length > 0) {
                            let template = '';
                            let template_bar = '';

                            medios.forEach(medio => {
                                let descripcion = '';
                                descripcion += '<li>tipo: ' + medio.tipo + '</li>';
                                descripcion += '<li>region: ' + medio.region + '</li>';
                                descripcion += '<li>genero: ' + medio.genero + '</li>';
                                descripcion += '<li>duracion: ' + medio.duracion + '</li>';

                                template += `
                                    <tr mediaId="${medio.id}">
                                        <td>${medio.id}</td>
                                        <td><a href="#" class="media-item">${medio.titulo}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="media-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${medio.titulo}</il>
                                `;
                            });

                            $('#media-result').show();
                            $('#container').html(template_bar);
                            $('#media').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#media-result').hide();
        }
    });

    
    $('#media-form').submit(e => {
        e.preventDefault();

        let postData = JSON.parse( $('#description').val() );
        postData['titulo'] = $('#title').val();
        postData['id'] = $('#mediaId').val();

        const url = edit === false ? './backend/media-add.php' : './backend/media-edit.php';
        
        $.post(url, postData, (response) => {
            console.log(response);
            let respuesta = JSON.parse(response);
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
            $('#title').val('');
            $('#description').val(JsonString);
            $('#media-result').show();
            $('#container').html(template_bar);
            listarMedios();
            edit = false;
        });
    });
    

    $(document).on('click', '.media-delete', (e) => {
        if (confirm('¿Realmente deseas eliminar la Pelicula|Serie?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('mediaId');
            $.post('./backend/media-delete.php', {id}, (response) => {
                console.log(response);
            let respuesta = JSON.parse(response);
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
                $('#media-result').show();
                $('#container').html(template_bar);
                listarMedios();
            });
        }
    });

    $(document).on('click', '.media-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('mediaId');
        $.post('./backend/media-single.php', {id}, (response) => {
            let medio = JSON.parse(response);
            $('#title').val(medio.titulo);
            $('#mediaId').val(medio.id);
            delete(medio.titulo);
            delete(medio.eliminado);
            delete(medio.id);
            let JsonString = JSON.stringify(medio, null, 2);
            $('#description').val(JsonString);
            edit = true;
        });
        e.preventDefault();
    });    
});
