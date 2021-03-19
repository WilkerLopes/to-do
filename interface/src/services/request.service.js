const URL = 'http://localhost:5000';

/**
 * Função prar fazer todas as requisições usando o fetch()
 * 
 * @param {String} router 
 * @param {Object} options 
 */
export default function requestService(router, options) {
  return fetch(URL + router, options)
    .then((resp) => resp.json())
    .then(function(response) {
      return response;
    });
}