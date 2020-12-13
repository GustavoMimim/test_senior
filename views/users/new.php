<h1>Adicionar usuário</h1>

<form action="?controller=users&action=insert" method="post" class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="username" class="form-label">Nome de usuário</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="..." minlength="4" maxlength="255" required>
        <div class="invalid-feedback">
            Por favor, adicione um nome de usuário válido de no mínimo 4 caracteres.
        </div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="..." minlength="6" maxlength="255" step="any" required>
        <div class="invalid-feedback">
            Por favor, adicione uma senha segura.
        </div>       
        <div id="emailHelp" class="form-text">Considere adicionar uma senha forte de no mínimo 6 caracteres.</div>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Função</label>
        <select class="form-select" id="type" name="type" aria-label="Default select example" required>
            <?php foreach ($types_users as $types) : ?>
                <option value="<?php echo $types->id; ?>"><?php echo $types->description; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Salvar <i data-feather="user-plus"></i></button>
    <a href="?controller=users&action=index" class="btn btn-dark">Voltar <i data-feather="x"></i></a>
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