<h1>Adicionar produto</h1>

<form action="?controller=products&action=insert" method="post" class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="description" class="form-label">Nome ou descrição do produto</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="..." minlength="2" maxlength="255" required>
        <div class="invalid-feedback">
            Por favor, adicione uma descrição.
        </div>
    </div>
  
    <div class="mb-3">
        <label for="price" class="form-label">Preço (R$)</label>
        <input type="number" class="form-control" id="price" name="price" placeholder="..." min="0" maxlength="12" step="any" required>
        <div class="invalid-feedback">
            É importante adicionar um valor ao seu produto, mas se não quiser fazer isso agora, você pode confirmar colocando o valor 0 (zero).
        </div>
    </div>
  
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="activated" name="activated" checked>
        <label class="form-check-label" for="activated">Ativo</label>
        <div id="emailHelp" class="form-text">Se ativo, o produto estará pronto para interagir com o sistema assim que adicioná-lo.</div>
    </div>
    
    <button type="submit" class="btn btn-primary">Salvar <i data-feather="file-plus"></i></button>
    <a href="?controller=products&action=index" class="btn btn-dark">Voltar <i data-feather="x"></i></a>
</form>

<script>

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