<?php namespace PCI\Repositories\User;

use PCI\Models\AbstractBaseModel;
use PCI\Repositories\AbstractRepository;
use PCI\Repositories\Interfaces\User\AddressRepositoryInterface;
use PCI\Repositories\Interfaces\User\EmployeeRepositoryInterface;

/**
 * Class AddressRepository
 * @package PCI\Repositories\User
 * @author Alejandro Granadillo <slayerfat@gmail.com>
 * @link https://github.com/slayerfat/sistemaPCI Repositorio en linea.
 */
class AddressRepository extends AbstractRepository implements AddressRepositoryInterface
{

    /**
     * El repositorio del que depende este.
     * @var \PCI\Repositories\Interfaces\User\EmployeeRepositoryInterface
     */
    private $empRepo;

    /**
     * Genera una instancia del repositorio.
     * Este depende del modelo Address y el repositorio de empleados.
     * @param \PCI\Models\AbstractBaseModel $model
     * @param \PCI\Repositories\Interfaces\User\EmployeeRepositoryInterface $empRepo
     */
    public function __construct(
        AbstractBaseModel $model,
        EmployeeRepositoryInterface $empRepo
    ) {
        parent::__construct($model);

        $this->empRepo = $empRepo;
    }

    /**
     * Consigue todos los elementos y devuelve una coleccion.
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Persiste informacion referente a una entidad.
     * Se sobrescribe del padre porque es
     * necesaria logica adicional.
     * @param array $data El array con informacion del modelo.
     * @return \PCI\Models\User
     */
    public function create(array $data)
    {
        // buscamos al empleado primero para saber que existe
        /** @var \PCI\Models\Employee $employee */
        $employee = $this->findParent($data['employee_id']);

        // creamos una nueva instancia con los datos
        // y la guardamos.
        /** @var \PCI\Models\Address $address */
        $address = $this->newInstance($data);
        $address->save();

        // asociamos al empleado con la nueva direccion.
        $employee->address_id = $address->id;
        $employee->save();

        // devolvemos al usuario porque el controlador
        // redirecciona a la vista de usuarios.
        return $employee->user;
    }

    /**
     * Busca al padre relacionado directamente con
     * este modelo, si existen varios padres,
     * entonces se devuelve el mas importante
     * en contexto al repositorio.
     * @param string|int $id El identificador unico (name|slug|int).
     * @return \PCI\Models\Employee
     */
    public function findParent($id)
    {
        return $this->empRepo->find($id);
    }

    /**
     * Actualiza algun modelo y lo persiste
     * en la base de datos del sistema.
     * @param int $id El identificador unico.
     * @param array $data El arreglo con informacion relacioada al modelo.
     * @return \PCI\Models\Address
     */
    public function update($id, array $data)
    {
        $address = $this->find($id);
        $address->load('employee.user');

        // por alguna razon, save no estaba funcionado
        // por eso se invoca fill antes del save.
        $address->fill($data)->save();

        return $address->employee->user;
    }

    /**
     * Busca algun Elemento segun Id u otra regla.
     * @param  string|int $id El identificador unico (slug|name|etc|id).
     * @return \PCI\Models\AbstractBaseModel
     */
    public function find($id)
    {
        return $this->getById($id);
    }

    /**
     * Elimina del sistema un modelo.
     * @param int $id El identificador unico.
     * @return boolean|\PCI\Models\AbstractBaseModel
     */
    public function delete($id)
    {
        return $this->executeDelete($id, 'Dirección');
    }

    /**
     * Genera la data necesaria que utilizara el paginator,
     * contiene los datos relevantes para la tabla, esta
     * informacion debe ser un array asociativo.
     * @param \PCI\Models\AbstractBaseModel $model
     * @return array<string, string> En donde el key es el titulo legible del campo.
     */
    protected function makePaginatorData(AbstractBaseModel $model)
    {
        // TODO: Implement makePaginatorData() method.
    }
}
