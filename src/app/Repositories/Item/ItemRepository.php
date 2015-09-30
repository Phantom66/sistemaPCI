<?php namespace PCI\Repositories\Item;

use PCI\Models\AbstractBaseModel;
use PCI\Repositories\AbstractRepository;
use PCI\Repositories\Interfaces\Aux\CategoryRepositoryInterface;
use PCI\Repositories\Interfaces\Item\ItemRepositoryInterface;
use PCI\Repositories\Traits\IteratesCollectionRelationTrait;
use PCI\Repositories\ViewVariable\ViewPaginatorVariable;

/**
 * Class ItemRepository
 * @package PCI\Repositories\Item
 * @author Alejandro Granadillo <slayerfat@gmail.com>
 * @link https://github.com/slayerfat/sistemaPCI Repositorio en linea.
 */
class ItemRepository extends AbstractRepository implements ItemRepositoryInterface
{

    use IteratesCollectionRelationTrait; // longNameIsLong

    /**
     * La implementacion del repositorio de categorias.
     * @var \PCI\Repositories\Interfaces\Aux\CategoryRepositoryInterface
     */
    private $catRepo;

    /**
     * La instancia de este repositorio.
     * Necesita el repo de categorias para el listado de crear/editar item.
     * @param \PCI\Models\AbstractBaseModel $model
     * @param \PCI\Repositories\Interfaces\Aux\CategoryRepositoryInterface $catRepo
     */
    public function __construct(AbstractBaseModel $model, CategoryRepositoryInterface $catRepo)
    {
        parent::__construct($model);
        $this->catRepo = $catRepo;
    }

    /**
     * Regresa variable con una coleccion y datos
     * adicionales necesarios para generar la vista.
     * @return \PCI\Repositories\ViewVariable\ViewPaginatorVariable
     */
    public function getIndexViewVariables()
    {
        return new ViewPaginatorVariable($this->getTablePaginator(), 'items');
    }

    /**
     * Genera un objeto LengthAwarePaginator con todos los
     * modelos en el sistema y con eager loading (si aplica).
     * @param int $quantity la cantidad a mostrar por pagina.
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getTablePaginator($quantity = 25)
    {
        return $this->generatePaginator($this->getAll(), $quantity);
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
     * Busca algun Elemento segun Id u otra regla.
     * @param  string|int $id El identificador unico (slug|name|etc|id).
     * @return \PCI\Models\AbstractBaseModel
     */
    public function find($id)
    {
        return $this->getBySlugOrId($id);
    }

    /**
     * Persiste informacion referente a una entidad.
     * @param array $data El array con informacion del modelo.
     * @return \PCI\Models\AbstractBaseModel
     */
    public function create(array $data)
    {
        $item = $this->model->newInstance();

        $item->fill($data);
        $item->save();

        return $item;
    }

    /**
     * Actualiza algun modelo y lo persiste
     * en la base de datos del sistema.
     * @param int $id El identificador unico.
     * @param array $data El arreglo con informacion relacionada al modelo.
     * @return \PCI\Models\AbstractBaseModel
     */
    public function update($id, array $data)
    {
        $item = $this->getById($id);

        $item->fill($data);
        $item->save();

        return $item;
    }

    /**
     * Elimina del sistema un modelo.
     * @param int $id El identificador unico.
     * @return boolean|\PCI\Models\AbstractBaseModel
     */
    public function delete($id)
    {
        return $this->executeDelete($id);
    }

    /**
     * Devuelve un array asociativo con
     * las categorias y subcategorias.
     * @return array[]
     */
    public function getSubCatsLists()
    {
        $catModels = $this->catRepo->getAll();

        return $this->createCollectionRelationArray($catModels, 'subCategories');
    }

    /**
     * Genera la data necesaria que utilizara el paginator,
     * contiene los datos relevantes para la tabla, esta
     * informacion debe ser un array asociativo.
     * Como cada repositorio contiene modelos con
     * estructuras diferentes, necesitamos
     * manener este metodo abstracto.
     * @param \PCI\Models\AbstractBaseModel|\PCI\Models\Item $model
     * @return array<string, string> En donde el key es el titulo legible del campo.
     */
    protected function makePaginatorData(AbstractBaseModel $model)
    {
        // por ahora no necesitamos datos de forma condicional.
        return [
            'uid'         => $model->id,
            'Descripción' => $model->desc,
            'Stock'       => $model->stock,
            'Rubro'       => $model->subCategory->desc,
            'Fabricante'  => $model->maker->desc,
        ];
    }
}
