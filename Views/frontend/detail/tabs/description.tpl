{extends file="parent:frontend/detail/tabs/description.tpl"}

{block name='frontend_detail_description_our_comment' append}
    {if $imzFilterDesc}
        <blockquote class="content--quote">{$imzFilterDesc}</blockquote>
    {/if}
{/block}
