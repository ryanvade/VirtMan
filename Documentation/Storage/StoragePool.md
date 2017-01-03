# (Model) StoragePool:

## A Libvirt storage pool that has storage volumes.

### Variables
* -name:string
* -path:string
* -type:string
* -autoStart:boolean
* -sourcePath:string[]
* -host:string[]
* -formatType:string
* -adapter:string
* -authUser:string
* -authPassword:string
* -secretUUID:string
* -capacityUnit:string
* -allocationUnit:string
* -capacitySize:int
* -allocationSize:int
* -permissions:int[]
* -port:int

### Functions
* +StoragePool()
  * returns a new StoragePool

| Argument       | Type     | Description
| ---            | ---      | ---
| name           | string   | Name of the Storage Pool
| path           | string   | Local path of the storage pool
| type           | string   | type of storage pool (see bellow for details)
| autoStart      | boolean  | Whether the storage pool should be configured at Libvirt Startup
| sourcePath     | string[] | Remote paths for the Storage Pool
| host           | string[] | Hosts for remote paths
| formatType     | string   | Type of storage system for the sourcePath
| adapter        | string   | Remote source connection adapter
| authUser       | string   | Username for remote source path
| authPassword   | string   | Password for remote source path
| secretUUID     | string   | UUID of RBD storage secret
| capacityUnit   | string   | Storage Unit for RBD storage
| allocationUnit | string   | Storage unit for RBD storage
| capacitySize   | int      | Size of the RBD storage in capacityUnit units
| allocationSize | int      | Used space on the RBD storage in allocationUnit units
| permissions    | int[]    | file permissions (see bellow for details)
| port           | int      | Remote connection port number

#### Storage Pool Type Details
| Types  
| ---
| dir (Default)
| fs
| netfs
| logical
| disk
| iscsi
| scsi
| mpath
| rbd
| sheepdog
| gluster
| zfs

#### Permissions Array Details
| Key   | type | Description
| ---
| Mode  | int  | Read, write, execute
| Owner | int  | Owner account who owns the pool
| Group | int  | Group who owns the pool

* +storageVolumes()
  * returns a Laravel Collection

* +storageImages()
  * returns a Laravel Collection
