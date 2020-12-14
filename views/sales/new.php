<h1>Venda de N° <?php echo $sale->id; ?></h1>

<form action="?controller=sales&action=update" method="post" class="needs-validation" novalidate>

    <div class="mb-3">
        <label for="date" class="form-label">Data de cadastro</label>
        <input type="datetime" class="form-control" id="date" name="date" aria-label="Data de cadastro" value="<?php echo $sale->created_at ?>" disabled>
    </div>

    <div class="mb-3">
        <label for="product-list" class="form-label">Adicionar novo produto</label>
        <div class="input-group">
            <div class="col col-md-2">
                <input type="number" class="col form-control" id="product-code" name="product-code" min="0" placeholder="Procure pelo código" aria-label="Procure pelo código">
            </div>
            <select class="form-select" id="product-list" name="product-list" onchange="selected_product_to_sold()" aria-label="Selecione o produto">
                <option value="" selected hidden>Ou selecione aqui</option>
                <?php foreach ($products as $product) : ?>
                    <option value="<?php echo $product->id; ?>"><?php echo $product->description; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div id="invalid-item-sold" class="invalid-feedback">
        </div>
    </div>

    <div class="mb-3">
        <div class="input-group">
            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantidade de unidades vendida" min="0" maxlength="12" step="any">
            <button class="btn btn-outline-primary" type="button" id="button-add-item" onclick="new_item_sold()">Adicionar à venda</button>
        </div>
    </div>

    <div class="mb-3">
        <label for="products-sold" class="form-label">Produtos já adicionados</label>
        <select class="form-select" id="products-sold" name="products-sold" multiple aria-label="Produtos à venda" disable>
        <?php foreach ($items as $item) : ?>
            <option><?php echo $item->description; ?></option>
        <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="confirm" name="confirm" <?php echo $sale->confirm == 1 ? 'checked' : ''; ?>>
        <label class="form-check-label" for="activated">Confirmar</label>
    </div>

    <div id="list-products-sold" name="list-products-sold">

    </div>

    <input type="hidden" value="<?php echo $sale->id; ?>" name="id" id="id">

    <button type="submit" class="btn btn-primary">Salvar <i data-feather="briefcase"></i></button>
    <a href="?controller=sales&action=index" class="btn btn-dark">Voltar <i data-feather="x"></i></a>
</form>

<script>
    function new_item_sold() {
        var selected = document.getElementById('product-list');
        if (selected.options.length > 0) {
            if (selected.options[selected.selectedIndex].value === '') {
                add_feedback('invalid-item-sold');
            } else {
                var products_sold = document.getElementById("products-sold");

                var already_sold = false;

                // Verificamos se o produto já foi adicionado
                Array.from(products_sold).forEach( function( option_element ) {
                    let option_value = option_element.value;
                    if( option_value == selected.options[selected.selectedIndex].text ) {
                        add_feedback('invalid-item-sold', 'Desculpe, esse item já foi adicionado!');
                        already_sold = true;
                        console.log('encontrou');
                    }
                });

                if( already_sold == false ) {

                    // Adicionamos na lista de itens vendidos
                    products_sold.options[products_sold.options.length] = new Option(selected.options[selected.selectedIndex].text, selected.options[selected.selectedIndex].value);

                    var hidden_inputs = document.getElementById("list-products-sold");

                    // Criamos o input com o código do produto
                    var new_element_code = document.createElement("input");
                    new_element_code.setAttribute("type", "hidden");
                    new_element_code.setAttribute("value", selected.options[selected.selectedIndex].value);
                    new_element_code.setAttribute("name", "products-sale-code[]");
                    
                    // Criamos o input com a quantidade vendida do produto
                    var quantity = document.getElementById("quantity");
                    var new_element_quantity = document.createElement("input");
                    new_element_quantity.setAttribute("type", "hidden");
                    new_element_quantity.setAttribute("value", quantity.value);
                    new_element_quantity.setAttribute("name", "products-sale-quantity[]");

                    hidden_inputs.appendChild(new_element_code);
                    hidden_inputs.appendChild(new_element_quantity);
                }

                clear_inputs();
            }
        }
    }

    function clear_inputs() {

        var product_code = document.getElementById("product-code");
        var product_list = document.getElementById("product-list");
        var quantity     = document.getElementById("quantity");

        product_code.value = "";
        product_list.value = "";
        quantity.value = "";

    }

    function selected_product_to_sold() {
        remove_feedback('invalid-item-sold');
        update_product_code();
    }

    function update_product_code() {        
        var selected  = document.getElementById('product-list');        
        var inputCode = document.getElementById('product-code');
        
        inputCode.value = selected.options[selected.selectedIndex].value;
    }

    function remove_feedback(id) {
        feedback = document.getElementById(id);
        feedback.style.display = 'none';
        feedback.innerHTML = '';
    }

    function add_feedback(id, msg = 'Por favor, selecione um produto válido.') {
        var feedback = document.getElementById(id);
        feedback.style.display = 'block'
        feedback.innerHTML = msg;
    }
/* 
    // Exemplo básico de validação de formulário com bootstrap v5
    // Percorre e valida os inputs, exibindo um feedback personalizavel de "valor válido" ou "valor inválido ", se houver
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })() */
</script>