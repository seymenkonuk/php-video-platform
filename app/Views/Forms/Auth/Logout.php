<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- CONTENT -->
<form
    action="/logout"
    method="POST"
    onsubmit="return addCsrfToken(this) && sanitizeForm(this)">

    <!-- Çıkış Yap Butonu -->
    <?= $this->insert("Components/Form/Submit", (array) new \App\Support\ViewProps\Components\Form\SubmitViewProp(
    id: null,
    icon: "bi-box-arrow-right",
    text: "Çıkış Yap",
    color: "bg-red-500",
    hoverColor: "bg-red-600",
    textColor: "text-white",
    fullWidth: true,
)) ?>

</form>