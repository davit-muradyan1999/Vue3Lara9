/**
 * This configuration was generated using the CKEditor 5 Builder. You can modify it anytime using this link:
 * https://ckeditor.com/ckeditor-5/builder/#installation/NoNgNARATAdAzPCkCMAGALFA7ADjjkAVnx2QE4dDDUt19lk7j0zCKqQoyQkIBTAHZJUYYMjAiR4qQF0UAYzIBDLHwAmEGUA=
 */

const {
    ClassicEditor,
    Alignment,
    Autosave,
    BlockQuote,
    Bold,
    Bookmark,
    Essentials,
    Heading,
    HorizontalLine,
    ImageEditing,
    ImageUtils,
    Indent,
    IndentBlock,
    Italic,
    Paragraph,
    Table,
    TableCaption,
    TableCellProperties,
    TableColumnResize,
    TableProperties,
    TableToolbar,
    Underline
} = window.CKEDITOR;

const LICENSE_KEY =
    'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NDMxMTk5OTksImp0aSI6ImU0MGJkMjU1LTI4MTEtNDg1Ny1iZmFiLWUzMjNlZGNlYzMxOSIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6IjNmNWU0ZmVlIn0.iWYDH8tSWPGoyh0eQarBNRmBFG4iMHxKUillgi3n_jc5aY-jJXZ08_ZIO0PtjE8HMhdaCNXybXkaL6NWvNbBXA';

const editorConfig = {
    toolbar: {
        items: [
            'heading',
            '|',
            'bold',
            'italic',
            'underline',
            '|',
            'horizontalLine',
            'bookmark',
            'insertTable',
            'blockQuote',
            '|',
            'alignment',
            '|',
            'outdent',
            'indent'
        ],
        shouldNotGroupWhenFull: false
    },
    plugins: [
        Alignment,
        Autosave,
        BlockQuote,
        Bold,
        Bookmark,
        Essentials,
        Heading,
        HorizontalLine,
        ImageEditing,
        ImageUtils,
        Indent,
        IndentBlock,
        Italic,
        Paragraph,
        Table,
        TableCaption,
        TableCellProperties,
        TableColumnResize,
        TableProperties,
        TableToolbar,
        Underline
    ],
    heading: {
        options: [
            {
                model: 'paragraph',
                title: 'Paragraph',
                class: 'ck-heading_paragraph'
            },
            {
                model: 'heading1',
                view: 'h1',
                title: 'Heading 1',
                class: 'ck-heading_heading1'
            },
            {
                model: 'heading2',
                view: 'h2',
                title: 'Heading 2',
                class: 'ck-heading_heading2'
            },
            {
                model: 'heading3',
                view: 'h3',
                title: 'Heading 3',
                class: 'ck-heading_heading3'
            },
            {
                model: 'heading4',
                view: 'h4',
                title: 'Heading 4',
                class: 'ck-heading_heading4'
            },
            {
                model: 'heading5',
                view: 'h5',
                title: 'Heading 5',
                class: 'ck-heading_heading5'
            },
            {
                model: 'heading6',
                view: 'h6',
                title: 'Heading 6',
                class: 'ck-heading_heading6'
            }
        ]
    },
    licenseKey: LICENSE_KEY,
    placeholder: 'Type or paste your content here!',
    table: {
        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
    }
};

ClassicEditor.create(document.querySelector('#editor'), editorConfig);
