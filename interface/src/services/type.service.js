import Request from './request.service'

class TypeService {
  async get() {
    const options = {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json;charset=UTF-8'
      }
    };

    var res = await Request('/type', options)
    return res
  }

  async create(title) {
    const options = {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json;charset=UTF-8'
      },
      body: JSON.stringify({
        "title": title
      })
    };

    var res = await Request('/type', options)
    return res
  }

  async edit(data) {
    const options = {
      method: 'PUT',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json;charset=UTF-8'
      },
      body: JSON.stringify({
        "id": data.id,
        "title": data.title
      })
    };

    var res = await Request('/type', options)
    return res
  }

  async remove(id) {
    const options = {
      method: 'DELETE',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json;charset=UTF-8'
      },
      body: JSON.stringify({
        "id": id
      })
    };

    var res = await Request('/type', options)
    return res
  }
}

export default new TypeService()