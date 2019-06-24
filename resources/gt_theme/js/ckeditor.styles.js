/*
Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/*
 * This file is used/requested by the 'Styles' button.
 * The 'Styles' button is not enabled by default in DrupalFull and DrupalFiltered toolbars.
 */
if(typeof(CKEDITOR) !== 'undefined') {
    CKEDITOR.addStylesSet( 'drupal',
    [
                /* Copying desired styles from "Format" drop-down list, 
                 * because we are only using ONE drop-down list in toolbar.
                 */
            
            /* Block Styles */

            { name : 'Heading'		    , element : 'h3' },
            { name : 'Subheading 1'		, element : 'h4' },
            { name : 'Subheading 2'		, element : 'h5' },
            { name : 'Subheading 3'		, element : 'h6' },
            { name : 'Preserve format', element : 'pre' },

            /* Alignment and Float */
            {
                    name : 'Left - Justify Text',
                    element : 'p',
                    attributes :
                    {
                        'class' : 'gt-ed-left-justify-text'
                    }
                },

                {
                    name : 'Center - Justify Text',
                    element : 'p',
                    attributes :
                    {
                        'class' : 'gt-ed-center-justify-text'
                    }
                },

                {
                    name : 'Right - Justify Text',
                    element : 'p',
                    attributes :
                    {
                        'class' : 'gt-ed-right-justify-text'
                    }
                },


                {
                    name : 'Float Left - Simple',
                    element : 'div',
                    attributes :
                    {
                            'class' : 'editor-float-left-simple'
                    }
            },
            {
                    name : 'Float Right - Simple',
                    element : 'div',
                    attributes :
                    {
                            'class' : 'editor-float-right-simple'
                    }
            },
            {
                    name : 'Float Left',
                    element : 'div',
                    attributes :
                    {
                            'class' : 'editor-float-left'
                    }
            },
            {
                    name : 'Float Left 70%',
                    element : 'div',
                    attributes :
                    {
                            'class' : 'editor-float-left-70'
                    }
            },
            {
                    name : 'Float Left 50%',
                    element : 'div',
                    attributes :
                    {
                            'class' : 'editor-float-left-50'
                    }
            },
            {
                    name : 'Float Left 30%',
                    element : 'div',
                    attributes :
                    {
                            'class' : 'editor-float-left-30'
                    }
            },
            {
                    name : 'Float Right',
                    element : 'div',
                    attributes :
                    {
                            'class' : 'editor-float-right'
                    }
            },
            {
                    name : 'Float Right 70%',
                    element : 'div',
                    attributes :
                    {
                            'class' : 'editor-float-right-70'
                    }
            },
            {
                    name : 'Float Right 50%',
                    element : 'div',
                    attributes :
                    {
                            'class' : 'editor-float-right-50'
                    }
            },
            {
                    name : 'Float Right 30%',
                    element : 'div',
                    attributes :
                    {
                            'class' : 'editor-float-right-30'
                    }
            },
            {
                    name : 'Clear Float Left',
                    element : 'div',
                    attributes :
                    {
                            'class' : 'editor-clear-float-left'
                    }
            },
            {
                    name : 'Clear Float Right',
                    element : 'div',
                    attributes :
                    {
                            'class' : 'editor-clear-float-right'
                    }
            },
            {
                    name : 'Clear Floats',
                    element : 'div',
                    attributes :
                    {
                            'class' : 'editor-clear-floats'
                    }
            },
            /* Links and Text */
            {
                    name : 'Yellow Highlight Button',
                    element : 'p',
                    attributes :
                    {
                            'class' : 'highlight-link-yellow'
                    }
            }, 
            {
                    name : 'Blue Highlight Button',
                    element : 'p',
                    attributes :
                    {
                            'class' : 'highlight-link-blue'
                    }
            },
            {
                    name : 'Gray Highlight Button',
                    element : 'p',
                    attributes :
                    {
                            'class' : 'highlight-link-gray'
                    }
            },
            {
                    name : 'Jump Link',
                    element : 'p',
                    attributes :
                    {
                            'class' : 'jump-link'
                    }
            },
            {
                    name : 'Intro Text',
                    element : 'p',
                    attributes :
                    {
                            'class' : 'intro-text'
                    }
            },
            {
                    name : 'Cutline Text',
                    element : 'p',
                    attributes :
                    {
                            'class' : 'cutline-text'
                    }
            },
            /* Hidden headings */
                {
                    name: 'Hidden Heading',
                    element: 'h3',
                    attributes:
                            {
                                'class': 'element-invisible element-focusable'
                            }
                },
                {
                    name: 'Hidden Subheading 1',
                    element: 'h4',
                    attributes:
                            {
                                'class': 'element-invisible element-focusable'
                            }
                },
                {
                    name: 'Hidden Subheading 2',
                    element: 'h5',
                    attributes:
                            {
                                'class': 'element-invisible element-focusable'
                            }
                },
                {
                    name: 'Hidden Subheading 3',
                    element: 'h6',
                    attributes:
                            {
                                'class': 'element-invisible element-focusable'
                            }
                },
            /* Pullquotes */
            {
                    name : 'Pull-quote - Left',
                    element : 'blockquote',
                    attributes :
                    {
                            'class' : 'pull-quote-left'
                    }
            },
            {
                    name : 'Pull-quote - Right',
                    element : 'blockquote',
                    attributes :
                    {
                            'class' : 'pull-quote-right'
                    }
            },
            /* Common html elements */
            
                {name: 'Computer Code', element: 'code'},
                {name: 'Cited Work', element: 'cite'},
                {name: 'Inline Quotation', element: 'q'},
                {name: 'Block Quotation', element: 'blockquote'},
            /* Icons for File types */
            {
                    name : 'PDF Icon',
                    element : 'span',
                    attributes :
                    {
                            'class' : 'editor-icon-pdf'
                    }
            },
            {
                    name : 'MS Word Icon',
                    element : 'span',
                    attributes :
                    {
                            'class' : 'editor-icon-doc'
                    }
            },
            {
                    name : 'MS Excel Icon',
                    element : 'span',
                    attributes :
                    {
                            'class' : 'editor-icon-xls'
                    }
            },
            {
                    name : 'MS PowerPoint Icon',
                    element : 'span',
                    attributes :
                    {
                            'class' : 'editor-icon-ppt'
                    }
            },
            {
                    name : 'Generic File Icon',
                    element : 'span',
                    attributes :
                    {
                            'class' : 'editor-icon-file'
                    }
            },
            /* Media wrapper */
            {
                    name : 'Embedded Media Wrapper',
                    element : 'div',
                    attributes :
                    {
                            'class' : 'media_embed'
                    }
            }
            
    ]);
}