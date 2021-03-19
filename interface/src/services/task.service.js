import Request from './request.service'

class TaskService {
  async get() {
    const options = {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json;charset=UTF-8'
      }
    };

    var res = await Request('/task', options)
    return res
  }

  async create(data) {
    const options = {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json;charset=UTF-8'
      },
      body: JSON.stringify({
        "title": data.title,
        "date_limite": data.date_limite,
        "id_type": data.id_type
      })
    };

    var res = await Request('/task', options)
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
        "title": data.title,
        "date_limite": data.date_limite,
        "id_type": data.id_type
      })
    };

    var res = await Request('/task', options)
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

    var res = await Request('/task', options)
    return res
  }

  async alterStatus(data) {
    const options = {
      method: 'PUT',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json;charset=UTF-8'
      },
      body: JSON.stringify({
        "id": data.id,
        "status_check": data.status_check
      })
    };

    var res = await Request('/task/status', options)
    return res
  }
}

export default new TaskService()