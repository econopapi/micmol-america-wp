# MicMol América WP -- Custom Astra Child Theme
Implementación custom del tema Astra (Tema hijo) para la marca MicMol América.

Autor: Daniel Limón  
Contacto: dani@dlimon.net  
Licencia: Pendiente

## Bloques Personalizados

- **MicMol Main Hero**: Bloque de hero para la frontpage. Está implementado en `custom-blocks/micmol-main-hero/` y es renderizado en servidor vía `includes/blocks.php`.
	- Editor: `custom-blocks/micmol-main-hero/block.js`
	- Estilos editor: `custom-blocks/micmol-main-hero/editor.css`
	- Estilos frontend: `custom-blocks/micmol-main-hero/style.css`
	- Registro y render: `includes/blocks.php`

Notas:
- El bloque está diseñado como dinámico (server-rendered) para mantener marcado accesible y fácil de actualizar.
- Personalizable: título, subtítulo, descripción, texto/enlace de botones y imagen vertical.
