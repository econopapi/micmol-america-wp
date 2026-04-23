( function( wp ) {
    var el = wp.element.createElement;
    var registerBlockType = wp.blocks.registerBlockType;
    var RichText = wp.blockEditor.RichText;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var MediaUpload = wp.blockEditor.MediaUpload;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var Button = wp.components.Button;

    registerBlockType( 'micmol/micmol-ecosystem-card', {
        title: 'MicMol Ecosystem Card',
        icon: 'screenoptions',
        category: 'layout',
        attributes: {
            subtitle: { type: 'string', default: '' },
            title: { type: 'string', default: '' },
            description: { type: 'string', default: '' },
            linkText: { type: 'string', default: 'Ver productos' },
            linkUrl: { type: 'string', default: '#' },
            iconUrl: { type: 'string', default: '' },
            iconAlt: { type: 'string', default: '' },
        },

        edit: function( props ) {
            var attrs = props.attributes;

            function onChangeSubtitle( value ) { props.setAttributes( { subtitle: value } ); }
            function onChangeTitle( value ) { props.setAttributes( { title: value } ); }
            function onChangeDescription( value ) { props.setAttributes( { description: value } ); }

            return el( 'div', { className: 'micmol-ecosystem-card-block' },
                el( InspectorControls, {},
                    el( PanelBody, { title: 'Link', initialOpen: true },
                        el( TextControl, { label: 'Link text', value: attrs.linkText, onChange: function( v ) { props.setAttributes( { linkText: v } ); } } ),
                        el( TextControl, { label: 'Link URL', value: attrs.linkUrl, onChange: function( v ) { props.setAttributes( { linkUrl: v } ); } } )
                    ),
                    el( PanelBody, { title: 'Icon', initialOpen: false },
                        el( 'div', { className: 'components-base-control' },
                            el( 'label', { className: 'components-base-control__label' }, 'Icon image' ),
                            el( MediaUpload, {
                                onSelect: function( media ) { props.setAttributes( { iconUrl: media.url, iconAlt: media.alt } ); },
                                allowedTypes: [ 'image', 'svg' ],
                                value: attrs.iconUrl,
                                render: function( obj ) {
                                    return el( Button, { isPrimary: true, onClick: obj.open }, attrs.iconUrl ? 'Replace icon' : 'Select icon' );
                                }
                            } ),
                            attrs.iconUrl ? el( 'div', { style: { marginTop: '8px' } }, el( 'img', { src: attrs.iconUrl, style: { maxWidth: '56px', maxHeight: '56px' } } ) ) : null
                        )
                    )
                ),

                el( 'article', { className: 'micmol-ecosystem-card' },
                    el( 'div', { className: 'micmol-ecosystem-card__top' },
                        attrs.iconUrl ? el( 'div', { className: 'micmol-ecosystem-card__icon-wrap' }, el( 'img', { src: attrs.iconUrl, className: 'micmol-ecosystem-card__icon', alt: attrs.iconAlt || '' } ) ) : el( 'div', { className: 'micmol-ecosystem-card__icon-wrap micmol-ecosystem-card__icon--placeholder' }, 'Icon' ),
                        el( RichText, { tagName: 'h3', className: 'micmol-ecosystem-card__title', value: attrs.title, onChange: onChangeTitle, placeholder: 'Iluminación LED' } )
                    ),

                    el( RichText, { tagName: 'div', className: 'micmol-ecosystem-card__desc', value: attrs.description, onChange: onChangeDescription, placeholder: 'Breve descripción del servicio o producto.' } ),

                    el( 'div', { className: 'micmol-ecosystem-card__actions' },
                        el( 'a', { className: 'micmol-ecosystem-card__link', href: attrs.linkUrl }, attrs.linkText )
                    )
                )
            );
        },

        save: function() {
            return null; // server-rendered
        }
    } );

} )( window.wp );
