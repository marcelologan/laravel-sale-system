@props(['itens' => []])

<script>
    window.pedidoData = window.pedidoData || {};
    window.pedidoData.itensExistentes = @json($itens);
</script>