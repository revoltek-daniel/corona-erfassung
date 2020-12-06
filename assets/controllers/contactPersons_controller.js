import { Controller } from 'stimulus';
import $ from 'jquery';

export default class extends Controller {
    connect() {
        var $addTagLink = $('<a href="#" class="add_item_link">Neue Person hinzufügen</a>');
        var $newLinkLi = $('<li></li>').append($addTagLink);

        $(document).ready(function() {
            // Get the ul that holds the collection
            let $personsCollectionHolder = $('ul.contact-persons');

            $personsCollectionHolder.append($newLinkLi);

            // count the current form inputs we have (e.g. 2), use that as the new
            // index when inserting a new item (e.g. 2)
            $personsCollectionHolder.data('index', $personsCollectionHolder.find('input').length);

            $('body').on('click', '.add_item_link', function(e) {
                e.preventDefault();
                // add a new tag form (see next code block)
                addTagForm($personsCollectionHolder, $newLinkLi);
            })
        });

        function addTagForm($collectionHolder, $newLinkLi) {
            // Get the data-prototype explained earlier
            let prototype = $collectionHolder.data('prototype');

            // get the new index
            let index = $collectionHolder.data('index');

            // Replace '$$name$$' in the prototype's HTML to
            // instead be a number based on how many items we have
            let newForm = prototype.replace(/__name__/g, index);

            // increase the index with one for the next item
            $collectionHolder.data('index', index + 1);

            // Display the form in the page in an li, before the "Add a tag" link li
            let $newFormLi = $('<li></li>').append(newForm);

            // also add a remove button, just for this example
            $newFormLi.append('<a href="#" class="remove-tag">x</a>');

            $newLinkLi.before($newFormLi);

            // handle the removal, just for this example
            $('.remove-tag').click(function(e) {
                e.preventDefault();

                $(this).parent().remove();

                return false;
            });
        }
    }
}