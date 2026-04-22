( function( wp ) {
    var el = wp.element.createElement;
    var registerBlockType = wp.blocks.registerBlockType;
    var RichText = wp.blockEditor.RichText;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var MediaUpload = wp.blockEditor.MediaUpload;
    var URLInputButton = wp.blockEditor.URLInputButton;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var Button = wp.components.Button;

    registerBlockType( 'micmol/micmol-main-hero', {
        title: 'MicMol Main Hero',
        icon: 'cover-image',
        category: 'layout',
        attributes: {
            titlePrimary: { type: 'string', default: '' },
            titleSecondary: { type: 'string', default: '' },
            subtitle: { type: 'string', default: '' },
            description: { type: 'string', default: '' },
            primaryText: { type: 'string', default: 'Descargar app' },
            primaryUrl: { type: 'string', default: '#' },
            secondaryText: { type: 'string', default: 'Ver productos' },
            secondaryUrl: { type: 'string', default: '#' },
            imageUrl: { type: 'string', default: '' },
        },

        edit: function( props ) {
            var attrs = props.attributes;

            function onChangeTitlePrimary( value ) { props.setAttributes( { titlePrimary: value } ); }
            function onChangeTitleSecondary( value ) { props.setAttributes( { titleSecondary: value } ); }
            function onChangeSubtitle( value ) { props.setAttributes( { subtitle: value } ); }
            function onChangeDescription( value ) { props.setAttributes( { description: value } ); }

            return el( 'div', { className: 'micmol-hero-block' },
                el( InspectorControls, {},
                    el( PanelBody, { title: 'Buttons', initialOpen: true },
                        el( TextControl, { label: 'Primary text', value: attrs.primaryText, onChange: function( v ) { props.setAttributes( { primaryText: v } ); } } ),
                        el( TextControl, { label: 'Primary URL', value: attrs.primaryUrl, onChange: function( v ) { props.setAttributes( { primaryUrl: v } ); } } ),
                        el( TextControl, { label: 'Secondary text', value: attrs.secondaryText, onChange: function( v ) { props.setAttributes( { secondaryText: v } ); } } ),
                        el( TextControl, { label: 'Secondary URL', value: attrs.secondaryUrl, onChange: function( v ) { props.setAttributes( { secondaryUrl: v } ); } } )
                    ),
                    el( PanelBody, { title: 'Visual', initialOpen: false },
                        el( 'div', { className: 'components-base-control' },
                            el( 'label', { className: 'components-base-control__label' }, 'Imagen móvil' ),
                            el( MediaUpload, {
                                onSelect: function( media ) { props.setAttributes( { imageUrl: media.url } ); },
                                allowedTypes: [ 'image' ],
                                value: attrs.imageId,
                                render: function( obj ) {
                                    return el( Button, { isPrimary: true, onClick: obj.open }, 'Seleccionar imagen' );
                                }
                            } ),
                            attrs.imageUrl ? el( 'div', { style: { marginTop: '8px' } }, el( 'img', { src: attrs.imageUrl, style: { maxWidth: '100%' } } ) ) : null
                        )
                    )
                ),

                el( 'div', { className: 'micmol-hero__inner' },
                    el( 'div', { className: 'micmol-hero__content' },
                        el( RichText, { tagName: 'div', className: 'micmol-hero__subtitle', value: attrs.subtitle, onChange: onChangeSubtitle, placeholder: 'Pequeño texto arriba' } ),
                        el( 'h1', { className: 'micmol-hero__title' },
                            el( RichText, { tagName: 'span', className: 'micmol-hero__title--primary', value: attrs.titlePrimary, onChange: onChangeTitlePrimary, placeholder: 'Control total.' } ),
                            el( RichText, { tagName: 'span', className: 'micmol-hero__title--secondary', value: attrs.titleSecondary, onChange: onChangeTitleSecondary, placeholder: 'Desde tu bolsillo.' } )
                        ),
                        el( RichText, { tagName: 'div', className: 'micmol-hero__desc', value: attrs.description, onChange: onChangeDescription, placeholder: 'Descripción breve para explicar la funcionalidad de la app.' } ),
                        el( 'div', { className: 'micmol-hero__actions' },
                            el( 'a', { className: 'micmol-button micmol-button--primary', href: attrs.primaryUrl }, attrs.primaryText ),
                            el( 'a', { className: 'micmol-button micmol-button--ghost', href: attrs.secondaryUrl }, attrs.secondaryText )
                        )
                    ),
                    el( 'div', { className: 'micmol-hero__visual' },
                        attrs.imageUrl ? el( 'img', { src: attrs.imageUrl, className: 'micmol-hero__image' } ) : el( 'div', { className: 'micmol-hero__image micmol-hero__image--placeholder' }, 'Imagen configurable (vertical)' )
                    )
                )
            );
        },

        save: function() {
            return null; // server-rendered
        }
    } );

} )( window.wp );
