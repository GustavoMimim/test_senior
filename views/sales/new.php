<h1>Adicionar venda</h1>

<form action="?controller=users&action=insert" method="post" class="needs-validation" novalidate>

    <div class="mb-3">
        <label for="date" class="form-label">Data de cadastro</label>
        <input type="datetime" class="form-control" id="date" name="date" aria-label="Data de cadastro" disabled>
    </div>  

    <div class="mb-3">
        <label for="product" class="form-label">Adicionar novo produto</label>
        <div class="input-group">
            <input type="number" class="input-group-text" id="productCode" name="productCode" placeholder="Procure pelo código" aria-label="Procure pelo código">
            <select class="form-select" id="product" name="product" aria-label="Example select with button addon">
                <option value="">ou selecione aqui</option>
                <?php foreach ($products as $product) : ?>
                    <option value="<?php echo $product->id; ?>"><?php echo $product->description; ?></option>
                <?php endforeach; ?>
            </select>
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Adicionar à venda</button>
        </div>
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Produtos já adicionados à venda</label>
        <select class="form-select" id="productsSale" name="productsSale" multiple aria-label="Produtos à venda">
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Salvar <i data-feather="user-plus"></i></button>
    <a href="?controller=users&action=index" class="btn btn-dark">Voltar <i data-feather="x"></i></a>
</form>

<script>

// Adiciona a data atual no input de date de cadastro
let current_datetime = new Date()
let formatted_date = current_datetime.getDate() + "/" + (current_datetime.getMonth() + 1) + "/" + current_datetime.getFullYear() + ' ' + current_datetime.getHours() + ':' + current_datetime.getMinutes()
document.getElementById('date').value = formatted_date;

// Exemplo básico de validação de formulário com bootstrap v5
// Percorre e valida os inputs, exibindo um feedback personalizavel de "valor válido" ou "valor inválido ", se houver
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>