'''

'''


from Decision.Builder.BuilderAbstract import BuilderAbstract
from Decision import Engine
import json


class Json(BuilderAbstract):
	
	_json = None
	
	
	'''
	
	'''
	def _get_json(self):
		
		return self._json
	
	
	'''
	
	'''
	def _set_json(self, json):
		
		self._json = Json
		return self
	
	
	json = property(fget=_get_json, fset=_set_json)
	
	
	'''
	
	'''
	def build(self):
	
		MyEngine = Engine()
		Object = json.loads(self._json)
		
		''' TODO: Needs to be recursive methods '''
		if Object['nodeType']:
			
			''' TODO: Valid object typeype check '''
			MyNode = getattr(Node, Object['nodeType'])()
			
			if Object['conditionNode']:
				
				''' TODO: Valid object typeype check '''
				MyCondition = getattr(Condition, Object['conditionNode']['conditionClass'])(
																							self._Context[Object['conditionNode']['contextProperty']],
																							Object['conditionNode']['configValue']
																							)
				MyNode.set_condition_node(MyCondition)
			
			MyEngine.set_root_node(MyNode)
		
		return MyEngine
