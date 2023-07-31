$(document).ready( function () {
    
    let create_tablas_filtradas = ( tablaid, controladorid ) => {
        const endpoint = "http://localhost/saga-cms";
        var opt = ""
        //
        switch ( controladorid ) {
            case "admin/grupos/associate":
                var url = endpoint + "/api/allacl"
                var controlador = "admin/grupos/associate"
                var columnas = [{data:"id"},{data:"roles"},{data:"controllers"},{data:"actions"},{data:"(string)null", width: "5%", searchable: false, sortable: false, defaultContent: "<a href=\"#\" name=\"editarbtn\" class=\"jsaction-edit\"><i class=\"fas fa-solid fa-eye\"></i></a>"}]                
                break         
            case "admin/usuarios":
                var url = endpoint + "/api/allusers"
                var controlador = "admin/usuarios"
                var columnas = [{data:"id"},{data:"empresa"},{data:"rut"},{data:"email"},{data:"nombre"},{data:"(string)null", width: "5%", searchable: false, sortable: false, defaultContent: "<a href=\"#\" name=\"editarbtn\" class=\"jsaction-edit\"><i class=\"fas fa-solid fa-eye\"></i></a><a href=\"#\" name=\"editarbtn\" class=\"jsaction-delete\"><i class=\"fa-solid fa-trash\"></i></a><a href=\"#\" name=\"editarbtn\" class=\"jsaction-activate\"><i class=\"fa-solid fa-thumbs-up\"></i></a>"}]                
                break
            case "admin/grupos":
                var url = endpoint + "/api/allroles"
                var controlador = "admin/grupos"
                var columnas = [{data:"id"},{data:"name"},{data:"description"},{data:"(string)null", width: "5%", searchable: false, sortable: false, defaultContent: "<a href=\"#\" name=\"editarbtn\" class=\"jsaction-edit\"><i class=\"fas fa-solid fa-eye\"></i></a><a href=\"#\" name=\"editarbtn\" class=\"jsaction-delete\"><i class=\"fa-solid fa-trash\"></i></a>"}]                
                break
            case "admin/categorias":
                var url = endpoint + "/api/allcategories"
                var controlador = "admin/categorias"
                var columnas = [{data:"id"},{data:"categoria"},{data:"nombre"},{data:"(string)null", width: "5%", searchable: false, sortable: false, defaultContent: "<a href=\"#\" name=\"editarbtn\" class=\"jsaction-edit\"><i class=\"fas fa-solid fa-eye\"></i></a><a href=\"#\" name=\"editarbtn\" class=\"jsaction-delete\"><i class=\"fa-solid fa-trash\"></i></a>"}]                
                break
            case "admin/maestros":
                var url = endpoint + "/api/allmaestros"
                var controlador = "admin/maestros"
                var columnas = [{data:"id"},{data:"nombre"},{data:"(string)null", width: "5%", searchable: false, sortable: false, defaultContent: "<a href=\"#\" name=\"editarbtn\" class=\"jsaction-edit\"><i class=\"fas fa-solid fa-eye\"></i></a><a href=\"#\" name=\"editarbtn\" class=\"jsaction-delete\"><i class=\"fa-solid fa-trash\"></i></a>"}]                
                break
            case "admin/blog":
                var url = endpoint + "/api/allblog"
                var controlador = "admin/blog"
                var columnas = [{data:"id"},{data:"titulo"},{data:"categoria"},{data:"fecha"},{data:"(string)null", width: "5%", searchable: false, sortable: false, defaultContent: "<a href=\"#\" name=\"editarbtn\" class=\"jsaction-edit\"><i class=\"fas fa-solid fa-eye\"></i></a><a href=\"#\" name=\"editarbtn\" class=\"jsaction-delete\"><i class=\"fa-solid fa-trash\"></i></a>"}]                
                break
            case "admin/empresas":
                var url = endpoint + "/api/allempresas"
                var controlador = "admin/empresas"
                var columnas = [{data:"id"},{data:"empresa"},{data:"(string)null", width: "5%", searchable: false, sortable: false, defaultContent: "<a href=\"#\" name=\"editarbtn\" class=\"jsaction-edit\"><i class=\"fas fa-solid fa-eye\"></i></a><a href=\"#\" name=\"editarbtn\" class=\"jsaction-delete\"><i class=\"fa-solid fa-trash\"></i></a>"}]                
                break
            case "admin/grupos/associate":
                var url = endpoint + "/api/allacl"
                var controlador = "admin/grupos/associate"
                var columnas = [{data:"id"},{data:"roles"},{data:"controllers"},{data:"actions"},{data:"(string)null", width: "5%", searchable: false, sortable: false, defaultContent: "<a href=\"#\" name=\"editarbtn\" class=\"jsaction-edit\"><i class=\"fas fa-solid fa-eye\"></i></a>"}]                
                break
            default:
              console.log(controladorid);
          }
          
        $('#' + tablaid).DataTable({
            "ajax": {            
                "url": url,
                "dataSrc": "data",
                "render": function(data, type) {
                    if(!data) return "";
                 }            
            },
            columns: columnas
        });
        //
        $("#" + tablaid).on("click", ".jsaction-edit", function(event){
            var recordId = getRecordId( $(this), tablaid );
            window.location.replace( endpoint + "/"+controlador+"/edit/" + recordId);
        });        
        $("#" + tablaid).on("click", ".jsaction-delete", function(event){
            var recordId = getRecordId( $(this), tablaid );
            window.location.replace( endpoint + "/"+controlador+"/delete/" + recordId);
        });
        $("#" + tablaid).on("click", ".jsaction-activate", function(event){
            var recordId = getRecordId( $(this), tablaid );
            window.location.replace( endpoint + "/"+controlador+"/activate/" + recordId);
        });
        // Get Record Id Of Current Row
        function getRecordId( selectedRow, tablaid ) {
            var data = $("#"+tablaid).DataTable().row((selectedRow).parents("tr")).data();
            return data.id;
        }

    }

    create_tablas_filtradas("users_admin_lista","admin/usuarios");
    create_tablas_filtradas("grupos_admin_lista","admin/grupos");
    create_tablas_filtradas("categorias_admin_lista","admin/categorias");
    create_tablas_filtradas("blog_admin_lista","admin/blog");
    create_tablas_filtradas("empresas_admin_lista","admin/empresas");
    create_tablas_filtradas("maestros_admin_lista","admin/maestros");
    create_tablas_filtradas("rolesasocciate_admin_lista","admin/grupos/associate");
} );
